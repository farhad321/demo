<?php

namespace App\Http\Livewire\Front\Blog;

use App\Models\Blog\Post;
use Livewire\Component;

class Show extends Component
{
 public Post $post;
 protected $listeners = [
  'viewed'
 ];
 public function render()
 {
  return view('livewire.front.blog.show');
 }
 public function viewed()
 {
  $this->post->update(['views' => $this->post->views + 1]);
 }
}