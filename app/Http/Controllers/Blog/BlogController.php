<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Ad\Ad;
use App\Models\Ad\Category;
use App\Models\Blog\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\Tags\Tag;
use Str;

class BlogController extends Controller
{
 public function index($page = 1)
 {
  request()->request->add([
                           'page' => $page
                          ]);
  $posts = Post::
  whereHas('category', function (Builder $q) {
   return $q->whereSlug('blog');
  })
               ->latest()
               ->paginate(6);
  $urls = $posts->linkCollection();
  $urls = $urls->map(function ($item) {
   $item['url'] = Str::of($item['url'])
                     ->replaceMatches("/\d*\?page=/", '',);
   return $item;
  });
  return view('blog.index', compact('urls', 'posts',));
 }

 public function adCategory($slug, $page = 1)
 {
  request()->request->add([
                           'page' => $page
                          ]);
  $category = Category::whereSlug(urlencode($slug))
                      ->first();
//  return
  $ads = Ad::
  whereHas('categories', function (Builder $q) use ($slug) {
   return $q->whereSlug(urlencode($slug));
  })
           ->with('categories')
           ->latest()
           ->paginate(16);
  $urls = $this->getUrls($ads);
  return view('ad.category', compact('urls', 'ads', 'category'));
 }

 public function tags($slug, $page = 1)
 {
  request()->request->add([
                           'page' => $page
                          ]);
  $locale = $locale ?? app()->getLocale();
//  return
  $tag = Tag::where("slug->{$locale}", $slug)
            ->whereType('post')
            ->first();
  $ads = Post::
  whereHas('tags', function (Builder $q) use ($slug, $locale) {
   return $q->where("slug->{$locale}", $slug)
            ->whereType('post');
  })
             ->with('tags')
             ->latest()
             ->paginate(16);
  $urls = $this->getUrls($ads);
  return view('ad.tag', compact('urls', 'ads', 'tag'));
 }

 public function post($y, $m, $d, $slug)
 {
//  return
  $post = Post::whereSlug(urlencode($slug))
              ->firstOrFail();
  return view('blog.post', compact('post'));
 }

 public function getUrls($ads): \Illuminate\Support\Collection
 {
  $linkCollection = $ads->linkCollection();
  $urls = $linkCollection->map(function ($item) {
   $item['url'] = Str::of($item['url'])
                     ->replaceMatches("/\/page\/\d*/", '',)
                     ->replaceMatches("/\?/", '/',)
                     ->replaceMatches("/\=/", '/',);
   return $item;
  });
  return $urls;
 }
}