<?php

namespace App\Http\Controllers\Front\Ad;

use App\Http\Controllers\Controller;
use App\Models\Ad\Ad;
use App\Models\Ad\Category;
use App\Models\Address\City;
use App\Models\Address\State;
use Illuminate\Database\Eloquent\Builder;
use LaravelIdea\Helper\App\Models\Ad\_IH_Ad_QB;
use LaravelIdea\Helper\App\Models\Ad\_IH_AdAttribute_QB;
use Str;

class AdsController extends Controller
{
 public function frontAdIndex($page = 1)
 {
  request()->request->add([
                           'page' => $page,
                          ]);
//  return
  $ads0 = $this->getAdQB();
  request()->request->add([
                           'total_page' => $ads0->total(),
                          ]);
  $urls = $this->getUrls($ads0);
  $ads = [];
  foreach ($ads0->items() as $key => $item) {
   $ads[$key] = $item->toArray();
  }
  return view('front.pages.ads.category.index', compact('urls', 'ads'));
 }

 public function frontAdCreate()
 {
  return view('front.pages.ads.create.create');
 }

 public function frontAdShow($slug)
 {
  $ad = Ad::with([
                  'favorites' => function ($q) {
                   if (auth()->check()) {
                    $q->whereUserId(auth()->id());
                   }
                  },
                  'mainCategory',
   'attrs'
                 ])
          ->whereSlug(urlencode($slug))
          ->first();
  $ad->update([
               'views' => $ad->views + 1,
              ]);
  request()->request->add([
                           'ad' => $ad,
                          ]);
  return view('front.pages.ads.show', compact('ad'));
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
                      ->firstOrFail();
  request()->request->add([
                           'page' => $page,
                           'category' => $category->id,
                           'category_page' => $category,
                          ]);
//  return
  $ads0 = $this->getAdQB();
  request()->request->add([
                           'total_page' => $ads0->total(),
                          ]);
  $urls = $this->getUrls($ads0);
  $ads = [];
  foreach ($ads0->items() as $key => $item) {
   $ads[$key] = $item->toArray();
  }
  return view('front.pages.ads.category.index', compact('urls', 'ads', 'category'));
 }

 public function frontAdCategoryCityIndex($slug, $page = 1)
 {
  $city = City::whereSlug($slug)
              ->first();
  if ($city) {
   request()->request->add([
                            'page' => $page,
                            'city' => $city->id,
                           ]);
  }
  else {
   $state = State::whereSlug($slug)
                 ->first();
   if ($state) {
    request()->request->add([
                             'page' => $page,
                             'state' => $state->id,
                            ]);
   }
   else {
    abort(404);
   }
  }
  $ads0 = $this->getAdQB();
  $urls = $this->getUrls($ads0);
  $ads = [];
  foreach ($ads0->items() as $key => $item) {
   $ads[$key] = $item->toArray();
  }
  return view('front.pages.ads.city-category.index', compact('urls', 'ads', 'city'));
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
  return $this->getAdQB()
              ->withPath(route('front.home'))
              ->withQueryString();
 }

 public function getAdQB(): array|\Illuminate\Pagination\LengthAwarePaginator|\LaravelIdea\Helper\App\Models\Ad\_IH_Ad_C
 {
  return Ad::query()
           ->when(request('min') || request('max'), function ($q) {
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
            $q->when(request('asc'), function ($q, $asc) use ($v) {
             $q->orderBy($v, $asc);
            });
           })
           ->when(request('orderBy') !== 'created_at', function ($q, $v) {
            $q->latest();
           })
           ->when(request('attributes'), function (/*_IH_Ad_QB*/ $q, $v) {
            $hasValue = false;
            foreach ($v as $item) {
             if ($item['value']) {
              $hasValue = true;
              break;
             }
            }
            if ($hasValue) {
             $q->whereHas('attrs', function (/*_IH_AdAttribute_QB*/ $q) use ($v) {
              foreach ($v as $attribute) {
               $q->when($attribute['value'], function ($q, $v) use ($attribute) {
                $q->where(function ($q) use ($attribute) {
                 $q->whereAdAttributeId($attribute['id']);
                 if ($attribute['value'] !== 'all') {
                  switch ($attribute['type']) {
                   case 'Text':
                    $q->whereText($attribute['value']);
                    break;
                  }
                 }
                });
               });
              }
             });
            }

           })
           ->whereIsVisible(true)
           ->with([
                   'state',
                   'city',
                   'media' => function ($q) {
                    $q->whereCollectionName('SpecialImage');
                   },
                   'mainCategory',
                   'favorites' => function ($q) {
                    if (auth()->check()) {
                     $q->whereUserId(auth()->id());
                    }
                   }
                  ])
           ->paginate(16);
 }
}