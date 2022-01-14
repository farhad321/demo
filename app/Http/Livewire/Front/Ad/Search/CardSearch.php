<?php

namespace App\Http\Livewire\Front\Ad\Search;

use App\Models\Ad\Ad;
use Livewire\Component;

class CardSearch extends Component
{
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
