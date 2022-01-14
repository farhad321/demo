<?php

namespace App\Http\Controllers\Front\Ad;

use App\Http\Controllers\Controller;
use App\Models\Ad\Ad;
use App\Models\Ad\Category;
use Illuminate\Database\Eloquent\Builder;
use LaravelIdea\Helper\App\Models\Ad\_IH_Ad_QB;
use Str;

class AdsController extends Controller
{
 public function frontAdCreate()
 {
  return view('front.pages.ads.create.create');
 }

 public function frontAdShow()
 {
  return view('front.pages.ads.show');
 }

 public function frontAdSearch($page = 1)
 {
  request()->request->add([
                           'page' => request()->page ?? $page
                          ]);
//  return
  $ads = Ad::
  when(request('s'), function ($q, $value) {
   $q->where(function ($q) use ($value) {
    $q->OrWhere('title', 'like', '%' . $value . '%')
      ->OrWhere('content', 'like', '%' . $value . '%')
      ->orWhereHas('tags', function (Builder $q) use ($value) {
       $q->where('name->fa', $value);
      });
   });
  })
           ->when(request('category'), function ($q, $value) {
            $q->whereHas('categories', function (Builder $q) use ($value) {
             $q->where('ad_categories.id', $value);
            });
           })
           ->whereIsVisible(true)
           ->with('mainCategory', 'media', 'state')
           ->latest()
           ->paginate(16)
           ->withQueryString();
//  return
  $urls = $this->getUrlsSearch($ads);
//  return view('ad.category', compact('urls', 'ads', 'category'));
  return view('front.pages.ads.search.index', compact('urls', 'ads'));
 }

 public function frontAdCategoryIndex($slug, $page = 1)
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
           ->whereIsVisible(true)
           ->with('mainCategory', 'media')
           ->latest()
           ->paginate(16);
//  return
  $urls = $this->getUrls($ads);
//  return view('ad.category', compact('urls', 'ads', 'category'));
  return view('front.pages.ads.category.index', compact('urls', 'ads', 'category'));
 }

 public function frontAdTagIndex()
 {
  return view('front.pages.ads.tag.index');
 }

 public function getUrls($ads): \Illuminate\Support\Collection
 {
  $linkCollection = $ads->linkCollection();
  $urls = $linkCollection->map(function ($item) {
   $item['disabled'] = false;
   $stringable = Str::of($item['label']);
   if ($stringable->contains([
                              'Next',
                              'Previous'
                             ]) && !$item['url']) {
    $item['disabled'] = true;
   }
   if ($stringable->contains('Previous')) {
    $item['label'] = '&laquo;';
   }
   elseif ($stringable->contains('Next')) {
    $item['label'] = '&raquo;';
   }
   $item['url'] = Str::of($item['url'])
                     ->replaceMatches("/\/page\/\d*/", '',)
                     ->replaceMatches("/\?/", '/',)
                     ->replaceMatches("/\=/", '/',);
   return $item;
  });
  return $urls;
 }

 public function getUrlsSearch($ads): \Illuminate\Support\Collection
 {
  $linkCollection = $ads->linkCollection();
  $urls = $linkCollection->map(function ($item) {
   $item['disabled'] = false;
   $stringable = Str::of($item['label']);
   if ($stringable->contains([
                              'Next',
                              'Previous'
                             ]) && !$item['url']) {
    $item['disabled'] = true;
   }
   if ($stringable->contains('Previous')) {
    $item['label'] = '&laquo;';
   }
   elseif ($stringable->contains('Next')) {
    $item['label'] = '&raquo;';
   }
   $item['url'] = Str::of($item['url'])
                     ->replaceMatches("/\/page\/\d*/", '',)
//                     ->replaceMatches("/\?/", '/',)
//                     ->replaceMatches("/\=/", '/',)
   ;
   return $item;
  });
  return $urls;
 }
}