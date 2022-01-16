<?php

namespace App\Models\Ad;

use App\Models\Address\City;
use App\Models\Address\State;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Tags\HasTags;

class Ad extends Model implements HasMedia
{
 use HasFactory;
 use InteractsWithMedia;
 use HasTags;

 protected $fillable = [
  'title',
  'slug',
  'content',
  'excerpt',
  'is_visible',
  'price',
  'seo_title',
  'seo_description',
  'views',
  'attributes',
  'user_id',
  'state_id',
  'city_id',
  'created_at',
  'updated_at'
 ];
 protected $casts = [
  'is_visible' => 'boolean',
  'attributes' => 'json',
 ];

 public function tags(): MorphToMany
 {
  return $this->morphToMany(self::getTagClassName(), 'taggable', 'taggables', null, 'tag_id')
              ->orderBy('order_column');
 }

 public function user(): BelongsTo
 {
  return $this->belongsTo(User::class);
 }

 public function state(): BelongsTo
 {
  return $this->belongsTo(State::class);
 }

 public function city(): BelongsTo
 {
  return $this->belongsTo(City::class);
 }

 public function categories(): BelongsToMany
 {
  return $this->belongsToMany(Category::class, 'ad_category_pivot', 'ad_id', 'ad_category_id')
              ->withPivot('is_main')
              ->withTimestamps();
 }

 public function mainCategory()
 {
  return $this->belongsToMany(Category::class, 'ad_category_pivot', 'ad_id', 'ad_category_id')
              ->wherePivot('is_main', 1);
 }

 public function favorites(): HasMany
 {
  return $this->hasMany(Favorite::class);
 }

 public function reports(): HasMany
 {
  return $this->hasMany(Report::class);
 }

 public function reviews(): HasMany
 {
  return $this->hasMany(Review::class);
 }

 public function attrs(): BelongsToMany
 {
  return $this->belongsToMany(Attribute::class, 'ad_attribute_pivot', 'ad_id', 'ad_attribute_id')
              ->withPivot('text', 'boolean', 'integer', 'float', 'date_time', 'date', 'json',)
              ->withTimestamps();
 }

 public function attrs2(): HasMany
 {
  return $this->hasMany(AdAttribute::class);
 }

// public function specialImage()
// {
//  return $this->media()
//              ->first();
// }
 public function registerMediaConversions(Media $media = null): void
 {
//  $this->addMediaConversion('thumb0')
//       ->fit(Manipulations::FIT_CROP, 400, 333)
//       ->performOnCollections('Gallery', 'SpecialImage');
//  $this->addMediaConversion('thumb1')
//       ->fit(Manipulations::FIT_CONTAIN, 400, 333)
//       ->performOnCollections('Gallery', 'SpecialImage');
//  $this->addMediaConversion('thumb2')
//       ->fit(Manipulations::FIT_FILL, 400, 333)
//       ->performOnCollections('Gallery', 'SpecialImage');
//  $this->addMediaConversion('thumb3')
//       ->fit(Manipulations::FIT_MAX, 400, 333)
//       ->performOnCollections('Gallery', 'SpecialImage');
//  $this->addMediaConversion('thumb4')
//       ->fit(Manipulations::FIT_STRETCH, 400, 333)
//       ->performOnCollections('Gallery', 'SpecialImage');
  $this->addMediaConversion('thumb')
       ->crop(Manipulations::CROP_CENTER, 400, 333)
       ->performOnCollections('SpecialImage');
  $this->addMediaConversion('70*70')
       ->crop(Manipulations::CROP_CENTER, 70, 70)
       ->performOnCollections('SpecialImage');
 }
}