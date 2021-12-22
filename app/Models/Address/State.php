<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends Model
{
 use HasFactory;

 /**
  * @var string
  */
 protected $table = 'address_states';
 /**
  * @var array<int, string>
  */
 protected $fillable = [
  'name',
 ];
 public function cities(): HasMany
 {
  return $this->hasMany(City::class);
 }
}