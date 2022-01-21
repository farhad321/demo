<?php

namespace App\Http\Livewire\Front\Ad;

use App\Http\Controllers\Front\Ad\AdsController;
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
 public bool $specialAd = false;
 public string $orderBy = '';
 public string $asc = 'asc';
// const orderByView = 'views';
// const orderByRelation = '';
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
  $this->page = request()->query('page', 1);
  $this->text = request()->query('s') ?? '';
  $this->city_id = request()->query('city_categories', 0);
  $this->category_id = request()->query('category', 0);
  $this->cities = City::all([
                             'id',
                             'name'
                            ])
                      ->sortBy('name');
 }

 public function updatedOrderBy($v)
 {
  if ($v) {
  $explode = explode('-',$v);
  $this->orderBy = $explode[0];
  $this->asc = $explode[1];
  }
  $this->startSearch();
  $this->orderBy = $v;
  $this->asc = 'asc';
 }

 public function startSearch()
 {
  $this->validate();
  request()->request->add([
                           'page' => $this->page,
                           'min' => $this->min,
                           'max' => $this->max,
                           'specialAd' => $this->specialAd,
//                           'orderBy' => 'views',
//                           'asc' => 'desc',
                           'orderBy' => $this->orderBy,
                           'asc' => $this->asc,
                          ]);
  $ads = (new AdsController())->searchAds();
  $this->emit('newAds', $ads->items(), $this->getUrlsSearch($ads));
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