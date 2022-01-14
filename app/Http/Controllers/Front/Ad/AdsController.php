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
  $ads0 = $this->searchAds();
  $urls = $this->getUrlsSearch($ads0);
  $ads = [];
  foreach ($ads0->items() as $key => $item) {
   $ads[$key] = $item->toArray();
  }
  return view('front.pages.ads.search.index', compact('urls', 'ads'));
 }

 public function frontAdCategoryIndex($slug, $page = 1)
 {
  $category = Category::whereSlug(urlencode($slug))
                      ->first();
  request()->request->add([
                           'page' => $page,
                           'category' => $category->id,
                          ]);
  $ads0 = $this->searchCategoryAds();
//  return
  $urls = $this->getUrls($ads0);
  $ads = [];
  foreach ($ads0->items() as $key => $item) {
   $ads[$key] = $item->toArray();
  }
//  return
//  $ads = Ad::
//  whereHas('categories', function (Builder $q) use ($slug) {
//   return $q->whereSlug(urlencode($slug));
//  })
//           ->whereIsVisible(true)
//           ->with('mainCategory', 'media')
//           ->latest()
//           ->paginate(16);
////  return
//  $urls = $this->getUrls($ads);
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

 public function searchAds(): array|\Illuminate\Pagination\LengthAwarePaginator|\LaravelIdea\Helper\App\Models\Ad\_IH_Ad_C
 {
  $ads = Ad::
  when(request('min') || request('max'), function ($q) {
   $q->whereNotNull('price');
   $q->when(request('min'), function ($q, $v) {
    $q->where('price', '>=', $v);
   });
   $q->when(request('max'), function ($q, $v) {
    $q->where('price', '<=', $v);
   });
  })
           ->when(request('city'), function ($q, $v) {
            $q->whereCityId($v);
           })
           ->when(request('s'), function ($q, $v) {
//            $q->where(function ($q) use ($v) {
            $q->OrWhere(function ($q) use ($v) {
             $q->OrWhere('title', 'like', '%' . $v . '%')
               ->OrWhere('content', 'like', '%' . $v . '%')
               ->orWhereHas('tags', function (Builder $q) use ($v) {
                $q->where('name->fa', $v);
               });
            });
           })
           ->when(request('category'), function ($q, $v) {
            $q->whereHas('categories', function (Builder $q) use ($v) {
             $q->where('ad_categories.id', $v);
            });
           })
           ->when(request('orderBy'), function ($q, $v) {
            $q->orderBy($v);
           })
           ->whereIsVisible(true)
           ->with('mainCategory', 'media', 'state')
           ->latest()
           ->paginate(16)
           ->withPath(route('front.home'))
           ->withQueryString();
  return $ads;
 }

 public function searchCategoryAds(): array|\Illuminate\Pagination\LengthAwarePaginator|\LaravelIdea\Helper\App\Models\Ad\_IH_Ad_C
 {
  $ads = Ad::
  when(request('min') || request('max'), function ($q) {
   $q->whereNotNull('price');
   $q->when(request('min'), function ($q, $v) {
    $q->where('price', '>=', $v);
   });
   $q->when(request('max'), function ($q, $v) {
    $q->where('price', '<=', $v);
   });
  })
           ->when(request('city'), function ($q, $v) {
            $q->whereCityId($v);
           })
           ->when(request('s'), function ($q, $v) {
//            $q->where(function ($q) use ($v) {
            $q->OrWhere(function ($q) use ($v) {
             $q->OrWhere('title', 'like', '%' . $v . '%')
               ->OrWhere('content', 'like', '%' . $v . '%')
               ->orWhereHas('tags', function (Builder $q) use ($v) {
                $q->where('name->fa', $v);
               });
            });
           })
           ->when(request('category'), function ($q, $v) {
            $q->whereHas('categories', function (Builder $q) use ($v) {
             $q->where('ad_categories.id', $v);
            });
           })
           ->when(request('orderBy'), function ($q, $v) {
            $q->orderBy($v);
           })
           ->whereIsVisible(true)
           ->with('mainCategory', 'media', 'state')
           ->latest()
           ->paginate(16);
  return $ads;
 }
}