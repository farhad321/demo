<?php

namespace App\Models;

use App\Models\Ad\Ad;
use App\Models\Blog\Post;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\Tag as SpatieTag;

class Tag extends SpatieTag
{
 public function posts()
 {
  return $this->morphedByMany(Post::class, 'taggable');
 }

 public function ads()
 {
  return $this->morphedByMany(Ad::class, 'taggable');
 }
}