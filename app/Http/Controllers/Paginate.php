<?php

namespace App\Http\Controllers;

use Str;

class Paginate extends \Illuminate\Pagination\LengthAwarePaginator
{
 public function linkCollection()
 {
  $linkCollection = parent::linkCollection();
  $linkCollection = $linkCollection->map(function ($item) {
   $item['url'] = Str::of($item['url'])
                     ->replaceMatches("/\d*\?page=/", '',);
   return $item;
  });
 }
}