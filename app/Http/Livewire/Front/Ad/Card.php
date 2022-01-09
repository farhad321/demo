<?php

namespace App\Http\Livewire\Front\Ad;

use App\Models\Ad\Ad;
use Livewire\Component;

class Card extends Component
{
 public Ad $ad;

 public function render()
 {
  return view('livewire.front.ad.card');
 }
}