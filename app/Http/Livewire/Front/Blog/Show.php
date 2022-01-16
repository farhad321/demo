<?php

namespace App\Http\Livewire\Front\Blog;

use App\Models\Blog\Post;
use Livewire\Component;

class Show extends Component
{
 public Post $post;

 public function render()
 {
  return view('livewire.front.blog.show');
 }
}