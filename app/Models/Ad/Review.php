<?php

namespace App\Models\Ad;

use App\Models\Lib\ClearsResponseCache;
use App\Models\Shop\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
 use HasFactory;
 use ClearsResponseCache;

 /**
  * @var string
  */
 protected $table = 'ad_reviews';
 /**
  * @var array<int, string>
  */
 protected $fillable = [
  'title',
  'content',
  'is_visible',
  'user_id',
  'ad_id',
 ];

 public function user(): BelongsTo
 {
  return $this->belongsTo(User::class);
 }

 public function ad(): BelongsTo
 {
  return $this->belongsTo(Ad::class);
 }
}