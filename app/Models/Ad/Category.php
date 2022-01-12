<?php

namespace App\Models\Ad;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model
{
 use HasFactory;
// use InteractsWithMedia;

 /**
  * @var string
  */
 protected $table = 'ad_categories';
 /**
  * @var array<int, string>
  */
 protected $fillable = [
  'name',
  'slug',
  'description',
  'position',
  'is_visible',
  'seo_title',
  'seo_description',
  'attributes',
  'parent_id'
 ];
 /**
  * @var array<string, string>
  */
 protected $casts = [
  'is_visible' => 'boolean',
  'attributes' => 'json',
 ];

 public function children(): HasMany
 {
  return $this->hasMany(Category::class, 'parent_id');
 }

 public function parent(): BelongsTo
 {
  return $this->belongsTo(Category::class, 'parent_id');
 }

 public function ads(): belongsToMany
 {
  return $this->belongsToMany(Ad::class, 'ad_category_pivot', 'ad_id', 'ad_category_id')
              ->withPivot('is_main')
              ->withTimestamps();
 }

 public function attrs(): BelongsToMany
 {
  return $this->belongsToMany(Attribute::class, 'ad_attribute_category_pivot', 'ad_category_id', 'ad_attribute_id');
 }
}