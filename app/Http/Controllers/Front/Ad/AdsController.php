<?php

namespace App\Http\Controllers\Front\Ad;

use App\Http\Controllers\Controller;

class AdsController extends Controller
{
 public function frontAdCreate()
 {
  return view('front.pages.ads.create.create');
 }

 public function frontAdShow()
 {
  return view('front.pages.ads.show');
 }

 public function frontAdCategoryIndex($slug, $page)
 {
  return view('front.pages.ads.category.index');
 }

 public function frontAdCategoryIndexFirstPage()
 {
  return view('front.pages.ads.category.index');
 }

 public function frontAdTagIndex()
 {
  return view('front.pages.ads.tag.index');
 }
}