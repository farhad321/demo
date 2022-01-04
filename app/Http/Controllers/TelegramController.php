<?php

namespace App\Http\Controllers;

use App\Http\Controllers\TelegramController\Ads;
use App\Http\Controllers\TelegramController\Methods;
use App\Http\Controllers\TelegramController\Profile;
use App\Http\Controllers\TelegramController\Register;
use App\Http\Controllers\TelegramController\Start;
use App\Models\User;
use Illuminate\Support\Collection;
use Telegram;
use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard;

//use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Objects\EditedMessage;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\Update;

//use Telegram;
class TelegramController extends Controller
{
 use Profile, Register, Ads, Start, Methods;

 //index
 public function index()
 {
  $t = new Api('5000545191:AAEQRciGRoWXjw42zwHyqJMUWaQB53WFezw');
  $u = $t->getWebhookUpdate();
  $m = $u->getMessage();
  $from = $m->from;
  switch ($u->detectType()) {
   case 'callback_query':
    $cqf = $u->callbackQuery->from;
    $this->login($cqf);
    break;
   default:
    $this->login($from);
    break;
  }
  switch ($u->detectType()) {
   case 'message':
    /////messaeg//////////////////////////////////////////
    switch ($m->detectType()) {
     /////text//////////////////////////////////////////
     case 'text':
      switch ($u->getMessage()->text) {
       case '/start':
        $this->start($t, $u);
        break;
       default:
        //چک آخرین پاسخ تا مشخص شود پاسخ برای چی هست.
        //بعد ذخیره سازی
        switch (auth()->user()->telegram_last_message) {
         case 'لطفا نوع حساب کاربری خود را مشخص کنید':
//          $this->profileRuleStore($t, $u, $m);
          break;
         case 'لطفا نام جدید خود را ارسال کنید':
          $this->profileFullNameStore($t, $u, $m);
          break;
         case 'لطفا رمز عبور جدید خود را ارسال کنید':
          $this->profilePasswordStore($t, $u, $m);
          break;
         case 'لطفا عنوان آگهی را ارسال کنید':
          $this->adsTitleStore($t, $u, $m);
          break;
         case 'لطفا استان را مشخص کنید':
          $this->adsStateStore($t, $u, $m);
          break;
         case 'لطفا نام شهر را مشخص کنید':
          $this->adsCityStore($t, $u, $m);
          break;
         case 'لطفا متن آگهی را وارد کنید':
          $this->adsContentStore($t, $u, $m);
          break;
        }
        break;
      }
      break;
     /////contact//////////////////////////////////////////
     case 'contact':
      switch (auth()->user()->telegram_last_message) {
       case 'شماره تلفن خود را تایید کنید.':
        $this->registerStore($t, $u, $m);
        break;
      }
      break;
     /////photo//////////////////////////////////////////
     case 'photo':
      switch (auth()->user()->telegram_last_message) {
       case 'لطفا عکس پروفایل خود را ارسال کنید':
        $this->profileAvatarStore($t, $u, $m);
        break;
      }
      break;
    }
    break;

//   case 'edited_message':
////    return $t->editedMessage;
//   case 'channel_post':
////    return $t->channelPost;
//   case 'edited_channel_post':
////    return $t->editedChannelPost;
//   case 'inline_query':
////    return $t->inlineQuery;
//   case 'chosen_inline_result':
////    return $t->chosenInlineResult;
   case 'callback_query':
    $cq = $u->callbackQuery;
    switch ($cq->data) {
     case 'startBack':
      $this->startBack($t, $u, $m);
      break;
     case 'profile':
      $this->profile($t, $u, $m);
      break;
     case 'profileRuleRequest':
      $this->profileRuleRequest($t, $u, $m);
      break;
     case 'profileFullNameRequest':
      $this->profileFullNameRequest($t, $u, $m);
      break;
     case 'profileAvatarRequest':
      $this->profileAvatarRequest($t, $u, $m);
      break;
     case 'profilePasswordRequest':
      $this->profilePasswordRequest($t, $u, $m);
      break;
     case 'adsList':
      $this->adsList($t, $u, $m);
      break;
     case 'adsCreate':
      $this->adsCreate($t, $u, $m);
      break;
     case 'adsEdit':
      $this->adsEdit($t, $u, $m);
      break;
     case 'adsDelete':
      $this->adsDelete($t, $u, $m);
      break;
     case 'adsTitleRequest':
      $this->adsTitleRequest($t, $u, $m);
      break;
     case 'adsStateRequest':
      $this->adsStateRequest($t, $u, $m);
      break;
     case 'adsCityRequest':
      $this->adsCityRequest($t, $u, $m);
      break;
     case 'adsContentRequest':
      $this->adsContentRequest($t, $u, $m);
      break;
     case 'adsGallery':
      $this->adsGallery($t, $u, $m);
      break;
     case 'register':
      $this->register($t, $u, $m);
      break;
    }
    break;
//   case 'shipping_query':
////    return $t->shippingQuery;
//   case 'pre_checkout_query':
////    return $t->preCheckoutQuery;
//   case 'poll':
////    return $t->poll;
  }
 }
}

