<?php

namespace App\Http\Controllers;

use App\Models\Ad\Ad;
use App\Models\Ad\Category;
use App\Models\Blog\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\Tags\Tag;
use Str;

class PageController extends Controller
{
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

 public function adTag($slug, $page = 1)
 {
  request()->request->add([
                           'page' => $page
                          ]);
  $locale = $locale ?? app()->getLocale();
//  return
  $tag = Tag::where("slug->{$locale}", $slug)
            ->whereType('ad')
            ->first();
  $ads = Ad::
  whereHas('tags', function (Builder $q) use ($slug, $locale) {
   return $q->where("slug->{$locale}", $slug)
            ->whereType('ad');
  })
           ->with('tags')
           ->latest()
           ->paginate(16);
  $urls = $this->getUrls($ads);
  return view('ad.tag', compact('urls', 'ads', 'tag'));
 }

 public function ad($slug)
 {
  $ad = Ad::whereSlug(urlencode($slug))
          ->firstOrFail();
  return view('ad.ad', compact('ad'));
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