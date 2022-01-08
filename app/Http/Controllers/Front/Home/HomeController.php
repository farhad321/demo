<?php

namespace App\Http\Controllers\Front\Home;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
 public function frontHome()
 {
  return view('front.pages.home.home.home');
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