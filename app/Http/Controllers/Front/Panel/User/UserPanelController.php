<?php

namespace App\Http\Controllers\Front\Panel\User;

use App\Http\Controllers\Controller;

class UserPanelController extends Controller
{
 public function frontPanelUserAdIndex()
 {
//  if (auth()->check()) {
  return view('front.pages.panel.user.ads.ads');
//  }
//  else {
//  }
 }

 public function frontPanelUserFavoriteIndex()
 {
  return view('');
 }

 public function frontPanelUserPaymentIndex()
 {
  return view('');
 }

 public function frontPanelUserProfileEdit()
 {
  return view('front.pages.panel.user.profile.edit');
 }

 public function frontPanelUserProfileShow()
 {
  return view('front.pages.panel.user.profile.show');
 }
}