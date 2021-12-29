<?php

namespace App\Models\Blog;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Tags\HasTags;

class Post extends Model
{
 use HasFactory;
 use HasTags;

 /**
  * @var string
  */
 protected $table = 'blog_posts';
 /**
  * @var array<int, string>
  */
 protected $fillable = [
  'title',
  'slug',
  'content',
  'published_at',
  'seo_title',
  'seo_description',
  'user_id'
 ];
 /**
  * @var array<string, string>
  */
 protected $casts = [
  'published_at' => 'date',
 ];

 public function user(): BelongsTo
 {
  return $this->belongsTo(User::class);
 }

 public function category(): BelongsTo
 {
  return $this->belongsTo(Category::class, 'blog_category_id');
 }
}
