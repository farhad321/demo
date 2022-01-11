<?php

namespace App\Http\Livewire\Front\Ad\Create\Main;
trait StateCity
{
 public function updatedAdStateid($v)
 {
  $this->ad->city_id = null;
 }
}