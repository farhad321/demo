<?php

namespace App\Http\Livewire\Front\Ad;

use App\Models\Ad\Category;
use App\Models\Address\City;
use Livewire\Component;

class Search extends Component
{
 public string $text = '';
 public int $city_id = 0;
 public int $category_id = 0;
 public $categories;
 public $cities;

 public function mount()
 {
  $this->text = request()->query('s') ?? '';
  $this->city_id = request()->query('city_categories') ?? 0;
  $this->category_id = request()->query('category') ?? 0;
  $this->categories = Category::all();
  $this->cities = City::all();
 }

 public function render()
 {
  return view('livewire.front.ad.search');
 }

 public function startSearch()
 {
  return redirect()->route('front.home', [
   's' => $this->text,
   'city_categories' => $this->city_id,
   'category' => $this->category_id,
  ]);
 }
}