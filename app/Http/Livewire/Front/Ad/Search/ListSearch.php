<?php

namespace App\Http\Livewire\Front\Ad\Search;

use Livewire\Component;

class ListSearch extends Component
{
 public $ads;
 public $urls;
 protected $listeners = ['newAds'];

 public function mount($ads, $urls)
 {
  $this->ads = $ads;
  $this->urls = $urls;
 }

 public function render()
 {
  return view('livewire.front.ad.search.list-search');
 }

 public function newAds($ads, $urls)
 {
//  dump($ads, $urls);
//  dump($this->ads,'1', $ads,'2', $this->urls,'3', $urls,'4');
  $this->ads = $ads;
  $this->urls = $urls;
 }
}