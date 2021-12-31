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

class SeedPostController extends Controller
{
 public function posts()
 {
  return $posts = Post::
  type('post')
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
   return $user->id;
  }
  else {
   return User::create([
                        'name' => collect([
                                           $WUser->first_name,
                                           $WUser->last_name
                                          ])->implode(''),
                        'phone' => $WUser->user_login,
//                 'birthday' => $this->faker->dateTimeThisCentury(),
//                        'address' => $this->faker->address(),
                        'email' => $WUser->email,
//                        'email_verified_at' => now(),
                        'password' => $WUser->user_pass,
                        'rule' => 'editor'
//                 'remember_token' => Str::random(10),
                       ])->id;
  }
 }

 /**
  * @param $posts
  */
 public function loop($posts): void
 {
  foreach ($posts as $post) {
//   return
//         $WUser = \Corcel\Model\User::whereId($post->author_id)
//                             ->get()->toArray();
   if (\App\Models\Blog\Post::whereSlug($post->slug)
                            ->exists()) {
    continue;
   }
   \DB::transaction(function () use ($post) {
    \App\Models\Blog\Post::create([
                                   'title' => $post->title,
                                   'slug' => $post->slug,
                                   'content' => $post->content,
                                   'excerpt' => $post->excerpt,
//                'is_visible' => 1,
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
                               'slug' => $post->slug,
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
  with('taxonomies')
                      ->type('post')
                      ->published()
                      ->chunk(20, function ($posts) {
                       foreach ($posts as $post) {
                        $ad = \App\Models\Blog\Post::whereSlug($post->slug)
                                                   ->first();
                        \DB::transaction(function () use ($post, $ad) {
                         foreach ($post->taxonomies as $taxonomy) {
                          switch ($taxonomy->taxonomy) {
                           case 'category':
                            $category = \App\Models\Blog\Category::whereSlug($taxonomy->term->slug)
                                                                 ->first();
                            $ad->category()
                               ->associate($category);
                            $ad->save();
                            break;
                           case 'post_tag':
                            $tag = Tag::whereSlug(urlencode($taxonomy->term->slug))
                                      ->first();
                            if ($tag) {
                             $ad->tags()
                                ->syncWithoutDetaching($tag);
                            }
                            else {
                             $ad->tags()
                                ->syncWithoutDetaching(Tag::create([
                                                                    'type' => 'post',
                                                                    'name' => $taxonomy->term->name,
                                                                    'slug' => $taxonomy->term->slug,
                                                                   ]));
                            }
                            break;
                          }
                         }
                        });
                       }
                      });
 }

 public function categories()
 {
  $categories = Taxonomy::where('taxonomy', 'category')
                        ->where('parent', 0)
                        ->get();
  foreach ($categories as $categoryOld) {
   $categoryParent = \App\Models\Blog\Category::firstOrCreate([
                                                               'slug' => $categoryOld->term->slug
                                                              ], [
                                                               'name' => $categoryOld->term->name,
                                                               'description' => $categoryOld->description,
                                                               'is_visible' => true,
//                                              'position' => $categoryOld->term->term_order
                                                              ]);
   $this->children($categoryOld, $categoryParent);
  }
 }

 public function children($categoryOld, $categoryParent): void
 {
  $childrenCategory = Taxonomy::whereParent($categoryOld->term_taxonomy_id)
                              ->get();
  foreach ($childrenCategory as $category) {
   $parent = \App\Models\Blog\Category::firstOrCreate([
                                                       'slug' => $category->term->slug
                                                      ], [
                                                       'parent_id' => $categoryParent->id,
                                                       'name' => $category->term->name,
                                                       'description' => $category->description,
                                                       'is_visible' => true,
//                                      'position' => $category->term->term_order
                                                      ]);
   $this->children($category, $parent);
  }
 }

 public function postAll()
 {
  $this->posts();
  $this->categories();
  $this->tags();
 }
}


