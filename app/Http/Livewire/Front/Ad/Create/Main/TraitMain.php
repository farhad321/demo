<?php

namespace App\Http\Livewire\Front\Ad\Create\Main;

use App\Models\Ad\Ad;

trait TraitMain
{
 public function goTo($to)
 {
  if ($to === 'category') {
   $this->resetExcept('categories');
  }
  if ($to === 'review') {
   $this->validate();
  }
  $this->step = $to;
 }

 public function store()
 {
  $this->validate();
  $ad = $this->ad;
  $ad->is_visible = false;
  $ad->user_id = auth()->id();
  $ad->save();
  $medias = auth()
   ->user()
   ->media()
   ->whereCollectionName('newAdGalleryWeb')
   ->get();
  foreach ($medias as $media) {
   $media->move($ad, 'Gallery');
  }
//  $this->reset();
  $this->step = 'category';
  $this->photos = [];
  $this->ad = new Ad();
 }
}