<?php

namespace App\Models\Ad;

use App\Models\Lib\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Attribute extends Model
{
 use HasFactory;
 use ClearsResponseCache;

 protected $table = 'ad_attributes';
 protected $fillable = [
  'name',
  'type',
  'options',
  'validation',
  'position',
  'is_filterable',
  'is_visible_on_front',
 ];
 protected $casts = [
  'options' => 'array'
 ];
 protected $appends = [
  'options_array',
 ];

 public function getOptionsArrayAttribute()
 {
  $options = $this->options;
  if ($options === null) {
   return [];
  }
  else {
   return collect($options)
    ->mapWithKeys(function ($item, $key) {
     return [$item['name'] => $item['name']];
    })
    ->toArray();
  }
 }

 public function categories(): BelongsToMany
 {
  return $this->belongsToMany(Category::class, 'ad_attribute_category_pivot', 'ad_attribute_id', 'ad_category_id');
 }

 public function ads(): BelongsToMany
 {
  return $this->belongsToMany(Ad::class, 'ad_attribute_pivot', 'ad_attribute_id', 'ad_id');
 }
}