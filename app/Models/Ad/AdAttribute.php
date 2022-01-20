<?php

namespace App\Models\Ad;

use App\Models\Lib\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AdAttribute extends Model
{
 use HasFactory;
 use ClearsResponseCache;

 protected $table = 'ad_attribute_pivot';
 protected $fillable = [
  'text',
  'boolean',
  'integer',
  'float',
  'date_time',
  'date',
  'json',
  'ad_id',
  'ad_attribute_id',
 ];
 protected $casts = [
//  'is_visible' => 'boolean',
  'json' => 'json',
 ];

 public function ad(): BelongsTo
 {
  return $this->belongsTo(Ad::class);
 }

 public function attribute(): BelongsTo
 {
  return $this->belongsTo(Attribute::class, 'ad_attribute_id', 'id');
 }
}