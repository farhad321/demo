<?php

namespace App\Http\Controllers\Front\Home;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\Ad\AdsController;

class HomeController extends Controller
{
 public function frontHome()
 {
  if (request()->query('s') || request()->query('city_categories') || request()->query('category')) {
   return (new AdsController())->frontAdSearch();
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