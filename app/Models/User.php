<?php

namespace App\Models;

use App\Models\Ad\Ad;
use App\Models\Ad\Favorite;
use App\Models\Ad\Report;
use App\Models\Ad\Review;
use App\Models\Address\City;
use App\Models\Address\State;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{
 use HasApiTokens;
 use HasFactory;
 use Notifiable;

 /**
  * @var array<int, string>
  */
 protected $fillable = [
  'name',
  'phone',
  'birthday',
  'address',
  'rule',
  'email',
  'password',
 ];
 /**
  * @var array<int, string>
  */
 protected $hidden = [
  'password',
  'remember_token',
 ];
 /**
  * @var array<string, string>
  */
 protected $casts = [
  'email_verified_at' => 'datetime',
  'birthday' => 'date',
 ];

 public function canAccessFilament(): bool
 {
  return true;
 }

 public function ads(): HasMany
 {
  return $this->hasMany(Ad::class);
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

 public function state(): BelongsTo
 {
  return $this->belongsTo(State::class);
 }

 public function city(): BelongsTo
 {
  return $this->belongsTo(City::class);
 }
}
