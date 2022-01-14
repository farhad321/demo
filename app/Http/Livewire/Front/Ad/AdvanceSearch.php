<?php

namespace App\Http\Livewire\Front\Ad;

use App\Models\Ad\Ad;
use App\Models\Ad\Category;
use App\Models\Address\City;
use Illuminate\Database\Eloquent\Builder;
use LaravelIdea\Helper\App\Models\Ad\_IH_Ad_QB;
use Livewire\Component;
use phpDocumentor\Reflection\Types\Boolean;
use Str;

class AdvanceSearch extends Component
{
 public function render()
 {
  return view('livewire.front.ad.advance-search');
 }

 public string $page = '';
 public string $text = '';
 public int $city_id = 0;
 public int $category_id = 0;
 public $cities;
//////////////////////////
 public int $min = 0;
 public int $max = 0;
 public Boolean $specialAd;
 public string $orderBy = '';
 const orderByView = 'view';
 const orderByRelation = '';
 protected $rules = [
  'min' => 'lte:max',
  'max' => 'gte:min',
 ];
 protected $validationAttributes = [
  'min' => 'کمترین قیمت',
  'max' => 'بیشترین قیمت'
 ];

 public function booted()
 {
  request()->request->add([
                           'category' => $this->category_id,
                           's' => $this->text,
                           'city' => $this->city_id,
                          ]);
 }

 public function mount()
 {
  $this->page = request()->query('page');
  $this->text = request()->query('s');
  $this->city_id = request()->query('city_categories');
  $this->category_id = request()->query('category');
  $this->cities = City::all([
                             'id',
                             'name'
                            ])
                      ->sortBy('name');
 }

 public function startSearch()
 {
  $this->validate();
//  dump(request()->all(),$this->category_id);
//  dump('requ)');
//  dump(request()->all());
  request()->request->add([
                           'page' => $this->page
                          ]);
//  return
  $ads = Ad::
  when($this->min || $this->max, function ($q) {
   $q->whereNotNull('price');
   $q->when($this->min, function ($q, $value) {
    $q->where('price', '>=', $value);
   });
   $q->when($this->max, function ($q, $value) {
    $q->where('price', '<=', $value);
   });
  })
           ->when(request('city'), function ($q, $value) {
            $q->whereCityId($value);
           })
           ->when(request('s'), function ($q, $value) {
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
           ->when($this->orderBy, function ($q, $value) {
            $q->orderBy($value);
           })
           ->whereIsVisible(true)
           ->with('mainCategory', 'media', 'state')
           ->latest()
           ->paginate(16)
           ->withPath(route('front.home'))
           ->withQueryString();
//  return
  $urls = $this->getUrlsSearch($ads);
//  dump($ads->items());
  $this->emit('newAds', $ads->items(), $urls);
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