<?php

namespace App\Services\Tag;

use Str;

class CustomSlugger
{
 public static function slugFarhad($tagName)
 {
  return Str::replace(' ', '-', $tagName);
 }
}