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
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements FilamentUser, HasMedia
{
 use HasApiTokens;
 use HasFactory;
 use Notifiable;
 use InteractsWithMedia;

 /**
  * @var array<int, string>
  */
 protected $fillable = [
  'name',
  'first_name',
  'last_name',
  'phone',
  'birthday',
  'address',
  'description',
  'rule',
  'email',
  'password',
  'telegram_id',
  'telegram_first_name',
  'telegram_last_name',
  'telegram_username',
  'telegram_last_message',
  'telegram_last_message_id',
  'extra'
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
  'extra' => 'json'
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

 public function setExtraAttribute($value)
 {
  $this->attributes['extra'] = json_encode($value);
 }

 public function getExtraAttribute()
 {
  return json_decode($this->attributes['extra']);
 }

 public function registerMediaConversions(Media $media = null): void
 {
  $this->addMediaConversion('avatar')
       ->crop(Manipulations::CROP_CENTER, 150, 150)
       ->performOnCollections('profile');
 }
}
