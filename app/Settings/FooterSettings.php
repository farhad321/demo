<?php

namespace App\Settings;
use Spatie\LaravelSettings\Settings;
class FooterSettings extends Settings
{
 public string $site_name;

 public bool $site_active;

 public static function group(): string
 {
  return 'general';
 }
}