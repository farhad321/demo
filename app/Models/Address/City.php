<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
 use HasFactory;

 /**
  * @var string
  */
 protected $table = 'address_cities';
 /**
  * @var array<int, string>
  */
 protected $fillable = [
  'name',
  'state_id'
 ];

 public function state(): BelongsTo
 {
  return $this->belongsTo(State::class);
 }
}