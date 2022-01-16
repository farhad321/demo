<?php

namespace App\Http\Livewire\Front\Ad\Search;

use App\Http\Livewire\Front\Ad\Search\Favorite;
use App\Models\Ad\Ad;
use Livewire\Component;

class CardSearch extends Component
{
 use Favorite;

 public array $ad;

 public function render()
 {
  return view('livewire.front.ad.search.card-search');
 }

// public function addToFavorites()
// {
//  $this->ad->favorites()
//           ->create(['user_id' => auth()->id()]);
////  \Cookie::
// }
}
