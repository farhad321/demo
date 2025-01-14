<?php

namespace App\Models\Blog;

use App\Models\Lib\ClearsResponseCache;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Tags\HasTags;
use Spatie\MediaLibrary\HasMedia;
use Str;

class Post extends Model implements HasMedia
{
 use HasFactory;
 use HasTags;
 use InteractsWithMedia;
 use ClearsResponseCache;

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
  'user_id',
  'views',
  'created_at',
  'updated_at'
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

 public function registerMediaConversions(Media $media = null): void
 {
  $this->addMediaConversion('thumb')
   ->crop(Manipulations::CROP_CENTER, 400, 333)
   ->performOnCollections('SpecialImage');
//  $this->addMediaConversion('singlePage')
//       ->crop(Manipulations::CROP_CENTER, 641, 534)
//       ->performOnCollections('SpecialImage');
  $this->addMediaConversion('150_150')
   ->crop(Manipulations::CROP_CENTER, 150, 150)
   ->performOnCollections('SpecialImage');
//  $this->addMediaConversion('300x300')
//       ->crop(Manipulations::CROP_CENTER, 150, 150)
//       ->performOnCollections('SpecialImage','gallery');
 }

 public function getLinkAttribute()
 {
  $t = jdate($this->created_at);
  return route('front.blog.show', [
   $t->getYear(),
   $t->getMonth(),
   $t->getDay(),
   $this->slug
  ]);
 }
 public function getLimitContentAttribute()
 {
  $content= Str::replace($this->title, '', $this->content);
  $content= strip_tags($content);
  return Str::limit($content);
 }
}
