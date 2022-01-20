<?php

namespace App\Http\Livewire\Front\Ad\Search;

use App\Models\Ad\Ad;
use Spatie\ResponseCache\Facades\ResponseCache;

trait Favorite
{
 public $local;
 public $favorits;
 public $isFavorite = false;

 public function favorite()
 {
  $ad = new Ad();
  $ad->fill($this->ad);
  $ad->id = $this->ad['id'];
  if (auth()->check()) {
   if ($this->isFavorite) {
    \App\Models\Ad\Favorite::whereUserId(auth()->id())
                           ->whereAdId($this->ad->id)
                           ->first()?->delete();
    $this->favorits = json_encode([]);
    $mainMassage = 'آگهی با موفقیت از علاقمندی های شما حذف شد.';
    $this->isFavorite = false;
   }
   else {
    $this->isFavorite = true;
    $b = $ad->favorites()
            ->create([
                      'user_id' => auth()->id(),
                     ]);
    $this->favorits = json_encode([]);
   }
   $message = '( بر روی همه سیستم هایی که با این حساب وارد شده اید ، در دسترس است.)';
  }
  else {
   $this->local = true;
   $storedFavorites = json_decode(json_decode($_COOKIE['favorites']));
   if ($this->isFavorite) {
    $newList = array_diff($storedFavorites, [$this->ad['id']]);
    $newList = array_values($newList);
    $mainMassage = 'آگهی با موفقیت از علاقمندی های شما حذف شد.';
    $this->isFavorite = false;
   }
   else {
    $this->isFavorite = true;
    $newList = array_merge($storedFavorites, [
     $this->ad['id'],
    ]);
   }
   $this->favorits = json_encode($newList);
   $message = '(تنها بر روی این سیستم در دسترس است.)';
   ResponseCache::clear();
  }
  $this->dispatchBrowserEvent('swal:modal', [
   'icon' => 'success',
   'title' => ($mainMassage ?? 'آگهی با موفقیت به علاقمندی های شما اضافه شد.') . $message,
   'timerProgressBar' => true,
   'timer' => 20000,
   'confirmButtonText' => '<i class="fa fa-thumbs-up"></i> متوجه شدم',
   'width' => 300
  ]);
 }

 public function mountFavorite(): void
 {
  if (auth()->check()) {
   if (isset($this->ad['favorites']) && count($this->ad['favorites'])) {
    $this->isFavorite = true;
   }
  }
  else {
   if (isset($_COOKIE['favorites'])) {
    $storedFavorites = json_decode(json_decode($_COOKIE['favorites']));
    $first = \Arr::first($storedFavorites, function ($value) {
     return $value == $this->ad['id'];
    });
    if ($first) {
     $this->isFavorite = true;
    }
   }
   else {
    $this->local = true;
    $this->favorits = json_encode([]);
    $this->isFavorite = false;
   }
  }
 }
}