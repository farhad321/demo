<?php

namespace App\Models\Ad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Attribute extends Model
{
 use HasFactory;

 protected $table = 'ad_attributes';
 protected $fillable = [
  'name',
  'type',
  'validation',
  'position',
  'is_filterable',
  'is_visible_on_front',
 ];

 public function categories(): BelongsToMany
 {
  return $this->belongsToMany(Category::class, 'ad_attribute_category_pivot', 'ad_attribute_id', 'ad_category_id');
 }

 public function ads(): BelongsToMany
 {
  return $this->belongsToMany(Ad::class, 'ad_attribute_pivot', 'ad_attribute_id', 'ad_id');
 }
}