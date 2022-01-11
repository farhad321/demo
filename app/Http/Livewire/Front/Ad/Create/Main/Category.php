<?php

namespace App\Http\Livewire\Front\Ad\Create\Main;

use App\Http\Livewire\Front\Ad\Create\Main;

trait Category
{
 public int $backToCategory = 0;
 public string $selectedCategory = '10';
 public array $categories = [];

 public function selectCategory($id)
 {
  $this->selectedCategory = $id;
  $this->step = 'form';
 }

 public function isFirstParent($category_id): bool
 {
  return $this->getFirstParent()
              ->contains($category_id);
 }

 public function getChildrenThisCategory($category_id)
 {
  return \App\Models\Ad\Category::whereParentId($category_id)
                                ->withCount('children')
                                ->orderBy('position')
                                ->orderBy('name')
                                ->get();
 }

 public function getFirstParent()
 {
  return $this->getChildrenThisCategory(null);
 }

 public function getChildren($category_id)
 {
  $this->backToCategory = $category_id;
  $this->categories = [...$this->getChildrenThisCategory($category_id)];
 }

 public function getChildrenBack()
 {
  if ($this->isFirstParent($this->backToCategory)) {
   $this->backToCategory = 0;
   $this->categories = [...$this->getFirstParent()];
  }
  else {
   $this->backToCategory = \App\Models\Ad\Category::find($this->backToCategory)->parent_id;
   $this->categories = [...$this->getChildrenThisCategory($this->backToCategory)];
  }
 }
}