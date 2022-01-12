<?php

namespace App\Http\Livewire\Front\Ad\Create\Main;

use App\Http\Livewire\Front\Ad\Create\Main;

trait Category
{
 public int $backToCategory = 0;
 public string $selectedCategory = '';
 public array $categories = [];

 public function selectCategory($id)
 {
  $this->selectedCategory = $id;
  $this->goTo('form');
 }

 public function isFirstParent($category_id): bool
 {
  return in_array($category_id, $this->getFirstParent());
//  return $this->getFirstParent()
//              ->contains($category_id);
 }

 public function getChildrenThisCategory($category_id)
 {
  $category_id = $category_id === 0 ? null : $category_id;
  return \App\Models\Ad\Category::whereParentId($category_id)
                                ->withCount('children')
                                ->orderBy('position')
                                ->orderBy('name')
                                ->get()
                                ->toArray();
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
   $parentId = \App\Models\Ad\Category::find($this->backToCategory)->parent_id;
   $this->backToCategory = $parentId === null ? 0 : $parentId;
   $this->categories = [...$this->getChildrenThisCategory($this->backToCategory)];
  }
 }
}