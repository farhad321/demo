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
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;

class Ad extends Model implements HasMedia
{
 use HasFactory;
 use InteractsWithMedia;
 use HasTags;

 protected $fillable = [
  'title',
  'slug',
  'description',
  'is_visible',
  'price',
  'seo_title',
  'seo_description',
  'views',
  'attributes',
  'user_id',
  'state_id',
  'city_id'
 ];
 protected $casts = [
  'is_visible' => 'boolean',
  'attributes' => 'json',
 ];

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
  return $this->belongsToMany(Category::class, 'ad_category_pivot', 'ad_id', 'ad_category_id');
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

 public function attributes(): BelongsToMany
 {
  return $this->belongsToMany(Attribute::class, 'ad_attribute_pivot', 'ad_id', 'ad_attribute_id')
              ->withPivot('text', 'boolean', 'integer', 'float', 'date_time', 'date', 'json',)
              ->withTimestamps();
 }

 public function attributes2(): HasMany
 {
  return $this->hasMany(AdAttribute::class);
 }
}