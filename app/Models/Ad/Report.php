<?php

namespace App\Models\Ad;

use App\Models\Lib\ClearsResponseCache;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
 use HasFactory;
 use ClearsResponseCache;

 protected $table = 'ad_reports';
 protected $fillable = [
  'title',
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