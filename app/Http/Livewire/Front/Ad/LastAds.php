<?php

namespace App\Http\Livewire\Front\Ad;

use App\Models\Ad\Ad;
use LaravelIdea\Helper\App\Models\Ad\_IH_Category_QB;
use LaravelIdea\Helper\App\Models\Ad\_IH_Favorite_QB;
use LaravelIdea\Helper\Spatie\MediaLibrary\MediaCollections\Models\_IH_Media_QB;
use Livewire\Component;

class LastAds extends Component
{
 public int $page = 0;
 public array $ads;
 public bool $hasPage = true;

 public function mount()
 {
  $this->page = 1;
  $ads = $this->getAds();
  $this->hasPage = $ads->hasMorePages();
  $this->ads = $ads->items();
 }

 public function nextPageaa()
 {
  $this->page = $this->page + 1;
  $ads = $this->getAds();
  $this->hasPage = $ads->hasMorePages();
  array_push($this->ads, ...$ads->items());
 }

 public function render()
 {
  return view('livewire.front.ad.last-ads');
 }

 public function getAds(): array|\Illuminate\Pagination\LengthAwarePaginator|\LaravelIdea\Helper\App\Models\Ad\_IH_Ad_C|\Illuminate\Contracts\Pagination\LengthAwarePaginator
 {
  $ads = Ad::with([
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
           ->whereIsVisible(true)
           ->paginate(20, '*', 'adsPage', $this->page);
  return $ads;
 }
}