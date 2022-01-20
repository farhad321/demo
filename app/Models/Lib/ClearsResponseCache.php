<?php

namespace App\Models\Lib;

use Spatie\ResponseCache\Facades\ResponseCache;

trait ClearsResponseCache
{
 public static function bootClearsResponseCache()
 {
  self::created(function ($a) {
//   dump($a->getDirty());
   ResponseCache::clear();
  });
  self::updated(function ($a) {
//   dump($a);
//   dump($a->getDirty());
   if (!isset($a->getDirty()['views'])) {
    ResponseCache::clear();
   }
  });
  self::deleted(function ($a) {
//   dump($a);
   ResponseCache::clear();
  });
 }
}