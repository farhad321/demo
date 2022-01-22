<?php

namespace App\Http\Controllers\Front\Home;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\Ad\AdsController;
use App\Models\Ad\Ad;

class HomeController extends Controller
{
 public function frontHome()
 {
  if (request()->query('s') || request()->query('city_categories') || request()->query('category')) {
   return (new AdsController())->frontAdSearch();
  }
  elseif (request()->query('p')) {
   $adWordpressId = Ad::where('extra->wordpressId', request()->query('p'))
                      ->first();
   if ($adWordpressId) {
    $slug = $adWordpressId->slug;
   }
   else {
    $slug = Ad::firstOrFail(request()->query('p'))->slug;
   }
   return (new AdsController())->frontAdShow($slug);
  }
  return view('front.pages.home.home.home');
 }

 public function frontLoginRegister()
 {
  return view('front.pages.home.login&register');
 }

 public function frontRules()
 {
  return view('front.pages.home.rules');
 }

 public function frontContactUs()
 {
  return view('front.pages.home.contact_us');
 }

 public function frontAboutUs()
 {
  return view('front.pages.home.about_us');
 }
}