<?php

namespace App\Http\Livewire\Front\Panel\User\Profile\Edit;
trait Media
{
 public $avatar;
 public $previewAvatar;

 public function updatedAvatar($v)
 {
  $this->validate([
                   'avatar' => 'image|max:1024',
                  ], [], [
                   'avatar' => 'عکس پروفایل'
                  ]);
  $user = auth()->user();
  if ($user->getFirstMedia('profile')) {
   $user->getFirstMedia('profile')
        ->delete();
  }
  $media = $user->addMedia($this->avatar)
                ->toMediaCollection('profile');
  $this->previewAvatar = $media->getUrl('avatar');
 }

 public function mediaDelete()
 {
  auth()
   ->user()
   ->getFirstMedia('profile')
   ->delete();
  $this->reset('avatar', 'previewAvatar');
 }
}