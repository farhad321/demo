<?php

namespace App\Http\Livewire\Front\Ad\Create\Main;
trait Media
{
 public $photos = [];
 public $previewPhotos = [];

 public function updatedPhotos($v)
 {
  $this->validate([
                   'photos.*' => 'image|max:1024',
                   'photos' => 'array|max:10',
                  ]);
  $user = auth()->user();
  foreach ($this->photos as $photo) {
   $user->addMedia($photo)
        ->toMediaCollection('newAdGalleryWeb');
  }
  $this->getPhoto($user);
 }

 public function mediaDelete(\Spatie\MediaLibrary\MediaCollections\Models\Media $media)
 {
  $media->delete();
  $this->getPhoto(auth()->user());
 }

 public function getPhoto(\App\Models\User|\Illuminate\Contracts\Auth\Authenticatable|null $user): void
 {
  $this->previewPhotos = $user->media()
                              ->whereCollectionName('newAdGalleryWeb')
                              ->get();
 }
}