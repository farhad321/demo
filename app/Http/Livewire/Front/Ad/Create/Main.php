<?php

namespace App\Http\Livewire\Front\Ad\Create;

use App\Http\Livewire\Front\Ad\Create\Main\StateCity;
use App\Models\Ad\Ad;
use App\Models\Ad\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use  App\Http\Livewire\Front\Ad\Create\Main\TraitMain;

class Main extends Component
{
 use TraitMain, \App\Http\Livewire\Front\Ad\Create\Main\Category, WithFileUploads, StateCity, \App\Http\Livewire\Front\Ad\Create\Main\Media;


// public string $step = 'category';
 protected $rules = [
  'ad.title' => 'required|string|min:3',
  'ad.content' => 'required|string',
  'ad.price' => 'required|numeric',
  'ad.state_id' => 'required|numeric',
  'ad.city_id' => 'required|numeric',
  'photos.*' => 'image|max:1024',
  'photos' => 'array|max:10',
 ];
 protected $validationAttributes = [
  'ad.price' => 'قیمت',
  'ad.state_id' => 'استان',
  'ad.city_id' => 'شهر',
  'photos.*' => 'فایل'
 ];

 public function mount()
 {
  $this->ad = new Ad();
  $this->categories = [...$this->getFirstParent()];
  $this->getPhoto(auth()->user());
 }

 public function render()
 {
//
//  foreach($this->errors as $key=>$error){
//
//   if (Str::is('photos*',$key)){
//
//    foreach ($error as $e){
//     $message.=$e;
//
//    }
//
//   }
//  }
  return view('livewire.front.ad.create.main');
 }
}
