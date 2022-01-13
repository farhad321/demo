<?php

namespace App\Http\Livewire\Front\Ad\Create\Main;

use App\Models\Ad\Ad;

trait TraitMain
{
 public Ad $ad;
 public string $step = 'category';

 public function goTo($to)
 {
  if ($to === 'category') {
//   $this->resetExcept('categories');
   $this->step = 'category';
//   $this->photos = [];
   $this->ad = new Ad();
  }
  if ($to === 'form') {
   $this->formAttributes = \App\Models\Ad\Category::
   find((int)$this->selectedCategory)?->attrs->toArray();
  }
  if ($to === 'review') {
   $this->validationAll();
  }
  $this->step = $to;
 }

 public array $formAttributes = [];

 public function updated($V, $n)
 {
//  dump($V, $n);
 }

 public function updatedFormAttributes($v)
 {
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
  $ad->categories()
     ->attach($this->selectedCategory, ['is_main' => true]);
  foreach ($medias as $key => $media) {
   if ($key === 0) {
    $media->move($ad, 'SpecialImage');
   }
   else {
    $media->move($ad, 'Gallery');
   }
  }
  foreach ($this->formAttributes as $attribute) {
//   $ad->attrs()->attach([
//    $attribute['id']=>['text'=>$attribute['text']]
//                        ]);
   $ad->attrs()
      ->attach($attribute['id'], ['text' => $attribute['text']]);
  }
//  $this->reset();
//  $this->step = 'category';
//  $this->backToCategory = 0;
//  $this->selectedCategory = '';
  $this->categories = [...$this->getFirstParent()];
  $this->reset('step', 'backToCategory', 'selectedCategory');
  $this->photos = [];
  $this->ad = new Ad();
  $this->formAttributes = [];
 }

 public function validationAll(): void
 {
  $list = [];
  foreach ($this->formAttributes as $key => $attribute) {
   if ($attribute['validation'] !== null) {
    $list['formAttributes.' . $key . '.text'] = $attribute['validation'];
   }
  }
  $listName = [];
  foreach ($this->formAttributes as $key => $attribute) {
   if ($attribute['validation'] !== null) {
    $listName['formAttributes.' . $key . '.text'] = $attribute['name'];
   }
  }
  $list = array_merge($this->rules, $list);
  $listName = array_merge($this->validationAttributes, $listName);
  $this->validate($list, [], $listName);
 }
}