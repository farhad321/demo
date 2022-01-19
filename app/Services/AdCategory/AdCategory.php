<?php

namespace App\Services\AdCategory;

use App\Models\Ad\Category;
use Illuminate\Database\Eloquent\Collection;

class AdCategory
{
 public function categoryAddress(Category $category)
 {
  $categories = Category::all();
  $list = [];
  $list = $this->categoryAddressChild($categories, $category, $list);
  return $list;
 }

 public function categoryAddressChild(Collection $categories, Category $category, $list)
 {
  $list = [
   $category,
   ...$list
  ];
  if ($category->parent_id) {
   $category = $categories->find($category->parent_id);
   $list = $this->categoryAddressChild($categories, $category, $list);
  }
  return $list;
 }
}