<?php

namespace App\Http\Controllers;

use App\Models\Ad\Ad;
use App\Models\Ad\Category;
use App\Models\Address\City;
use App\Models\Address\State;
use App\Models\User;
use Corcel\Model\Post;
use Corcel\Model\Taxonomy;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Tags\Tag;

class SeedController extends Controller
{
 public function ads()
 {
  return $posts = Post::

  type('product')
                      ->published()
                      ->chunk(20, function ($posts) {
                       $this->loop($posts);
                      });
 }

 public function userId($post): int
 {
  $WUser = \Corcel\Model\User::find($post->author_id);
  $user = User::whereEmail($WUser->email)
              ->first();
  if ($user) {
//   dump($WUser);
   return $user->id;
  }
  else {
//  dd($WUser);
   return User::create([
                        'name' => collect([
                                           $WUser->first_name,
                                           $WUser->last_name
                                          ])->implode(''),
                        'phone' => $WUser->user_login,
//                 'birthday' => $this->faker->dateTimeThisCentury(),
//                        'address' => $this->faker->address(),
                        'email' => $WUser->email,
                        'email_verified_at' => now(),
                        'password' => $WUser->user_pass,
//                 'remember_token' => Str::random(10),
                       ])->id;
  };
 }

 /**
  * @param $posts
  */
 public function loop($posts): void
 {
  foreach ($posts as $post) {
   if (Ad::whereSlug($post->slug)
         ->exists()) {
    continue;
   }
   \DB::transaction(function () use ($post) {
    Ad::create([
                'title' => $post->title,
                'slug' => urldecode($post->slug),
                'content' => $post->content,
                'excerpt' => $post->excerpt,
                'is_visible' => 1,
//              'price' =>,
                'seo_title' => $post->_yoast_wpseo_title,
                'seo_description' => $post->_yoast_wpseo_metadesc,
                'views' => $post->post_views_count,
//              'attributes' => ,
                'created_at' => $post->created_at,
                'updated_at' => $post->updated_at,
                'user_id' => $this->userId($post),
//   'state_id' => function () {
//    return State::factory()
//                ->create()->id;
//   },
//   'city_id' => function () {
//    return City::factory()
//               ->create()->id;
//   },
               ]);
   });
  }
 }

 public function comments()
 {
  return // \App\Models\Ad\AdAttribute::with('attribute')
//                                  ->get();
   $posts = Post::with('attachment', 'comments')
                ->has('comments')
                ->type('product')
                ->published()
                ->chunk(20, function ($posts) {
                 foreach ($posts as $post) {
                  $ad = Ad::whereSlug($post->slug)
                          ->get();
//                  Media::whereModelType('App\Models\Ad\Ad')->whereId($ad->id)
                  if ($ad->exists()) {
                   continue;
                  }
                  \DB::transaction(function () use ($post) {
                   Ad::create([
                               'title' => $post->title,
                               'slug' => urldecode($post->slug),
                               'content' => $post->content,
                               'excerpt' => $post->excerpt,
                               'is_visible' => 1,
//              'price' =>,
//              'seo_title' =>,
//              'seo_description' => ,
//              'views' => ,
//              'attributes' => ,
//              'created_at' => ,
//              'updated_at' => ,
                               'user_id' => $this->userId($post),
//   'state_id' => function () {
//    return State::factory()
//                ->create()->id;
//   },
//   'city_id' => function () {
//    return City::factory()
//               ->create()->id;
//   },
                              ]);
                  });
                 }
                })
//               ->count()
//  ->limit(100)
//   ->get()
   ;
 }

 public function media()
 {
  return // \App\Models\Ad\AdAttribute::with('attribute')
//                                  ->get();
   $posts = Post::with('attachment', 'comments')
                ->has('comments')
                ->type('product')
                ->published()
                ->chunk(20, function ($posts) {
                 foreach ($posts as $post) {
                 }
                })
//               ->count()
//  ->limit(100)
//   ->get()
   ;
 }

 public function tags()
 {
  return $posts = Post::
  with('taxonomies', 'thumbnail', 'attachment')
                      ->type('product')
                      ->published()
                      ->chunk(20, function ($posts) {
                       foreach ($posts as $post) {
                        $ad = Ad::whereSlug(urldecode($post->slug))
                                ->first();
                        \DB::transaction(function () use ($post, $ad) {
                         foreach ($post->taxonomies as $taxonomy) {
                          switch ($taxonomy->taxonomy) {
                           case 'city_categories':
                            if ($taxonomy->parent && !$ad->city_id) {
                             //city
                             $city = City::firstOrCreate(['slug' => $taxonomy->term->slug], [
                              'name' => $taxonomy->term->name,
//                       'state_id' =>
                             ]);
                             $ad->city()
                                ->associate($city);
                             $ad->save();
                            }
                            else if (!$taxonomy->parent && !$ad->state_id) {
                             //state
                             $state = State::firstOrCreate(['slug' => $taxonomy->term->slug], [
                              'name' => $taxonomy->term->name,
                             ]);
                             $ad->state()
                                ->associate($state);
                             $ad->save();
                            }
                            break;
                           case 'product_cat':
                            $category = Category::whereSlug($taxonomy->term->slug)
                                                ->first();
                            $mainCategoryId = $post->getMeta('_yoast_wpseo_primary_product_cat');
                            if ($mainCategoryId && $mainCategoryId == $taxonomy->term->term_id) {
                             $ad?->categories()
                                 ->attach($category->id, ['is_main' => true]);
                            }
                            else  if (!$mainCategoryId || $mainCategoryId !== $taxonomy->term->term_id)  {
                             $ad->categories()
                                ->attach($category->id);
                            }
                            break;
                           case 'product_tag':
                            $tag = Tag::where('name->fa', $taxonomy->term->name)
                                      ->first();
                            if ($tag) {
                             $ad->tags()
                                ->syncWithoutDetaching($tag);
                            }
                            else {
                             $ad->tags()
                                ->syncWithoutDetaching(Tag::create([
                                                                    'type' => 'ad',
                                                                    'name' => $taxonomy->term->name,
                                                                   ]));
                            }
                            break;
                          }
                         }
                        });
                        $storeThumbnail = false;
                        foreach ($post->attachment as $key => $attach) {
                         $file = storage_path('app/public/uploads/') . $attach->getMeta('_wp_attached_file');
                         $url = 'https://kiusk.ca/wp-content/uploads/' . $attach->getMeta('_wp_attached_file');
                         if (file_exists($file)) {
                          if ($post?->thumbnail?->attachment->ID == $attach->ID) {
                           $ad->addMedia($file)
//                            ->addMediaFromUrl($url)
                              ->toMediaCollection('SpecialImage');
                          }
                          elseif ($post?->thumbnail == null && $key == 0) {
                           $storeThumbnail = true;
                           $ad->addMedia($file)
//                            ->addMediaFromUrl($url)
                              ->toMediaCollection('SpecialImage');
                          }
                          else {
                           $ad->addMedia($file)
//                            ->addMediaFromUrl($url)
                              ->toMediaCollection('gallery');
                          }
                         }
                        }
                        if ($post?->thumbnail !== null && !$storeThumbnail) {
                         $file = storage_path('app/public/uploads/') . $post?->thumbnail->attachment->getMeta('_wp_attached_file');
                         $url = 'https://kiusk.ca/wp-content/uploads/' . $post?->thumbnail->attachment->getMeta('_wp_attached_file');
                         if (file_exists($file)) {
                          $ad->addMedia($file)
//                           ->addMediaFromUrl($url)
                             ->toMediaCollection('SpecialImage');
                         }
                        }
                       }
                      });
 }

 public function categories()
 {
//  return
  $categories = Taxonomy::where('taxonomy', 'product_cat')
                        ->where('parent', 0)
                        ->get();
  foreach ($categories as $categoryOld) {
   $categoryParent = Category::firstOrCreate([
                                              'slug' => $categoryOld->term->slug
                                             ], [
                                              'name' => $categoryOld->term->name,
                                              'description' => $categoryOld->description,
                                              'is_visible' => true,
                                              'position' => $categoryOld->term->term_order
                                             ]);
   $this->children($categoryOld, $categoryParent);
  }
 }

 public function children($categoryOld, $categoryParent): void
 {
  $childrenCategory = Taxonomy::whereParent($categoryOld->term_taxonomy_id)
                              ->get();
  foreach ($childrenCategory as $category) {
   $parent = Category::firstOrCreate([
                                      'slug' => $category->term->slug
                                     ], [
                                      'parent_id' => $categoryParent->id,
                                      'name' => $category->term->name,
                                      'description' => $category->description,
                                      'is_visible' => true,
                                      'position' => $category->term->term_order
                                     ]);
   $this->children($category, $parent);
  }
 }

 public function adAll()
 {
  $this->ads();
  $this->categories();
  $this->tags();
 }
}


