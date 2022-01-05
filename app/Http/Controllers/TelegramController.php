<?php

namespace App\Http\Controllers;

use App\Http\Controllers\TelegramController\Ads;
use App\Http\Controllers\TelegramController\Methods;
use App\Http\Controllers\TelegramController\Profile;
use App\Http\Controllers\TelegramController\Register;
use App\Http\Controllers\TelegramController\Start;
use App\Models\User;
use Illuminate\Support\Collection;
use Str;
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
          $this->adsCreateTitleStore($t, $u, $m);
          break;
         case 'لطفا متن آگهی را وارد کنید':
          $this->adsCreateContentStore($t, $u, $m);
          break;
         case 'لطفا قیمت را وارد کنید':
          $this->adsCreatePriceStore($t, $u, $m);
          break;
         case 'لطفا دسته بندی را انتخاب کنید':
          $this->adsCreateCatgoryStore($t, $u, $m);
          break;
         case 'لطفا عنوان آگهی را ویرایش کنید.':
          $this->adsEditTitleStore($t, $u, $m);
          break;
         case 'لطفا استان را ویرایش کنید.':
          $this->adsEditStateStore($t, $u, $m);
          break;
         case 'لطفا نام شهر را ویرایش کنید.':
          $this->adsEditCityStore($t, $u, $m);
          break;
         case 'لطفا متن آگهی را ویرایش کنید.':
          $this->adsEditContentStore($t, $u, $m);
          break;
         case 'لطفا قیمت را ویرایش کنید.':
          $this->adsEditPriceStore($t, $u, $m);
          break;
         case 'لطفا عکس را ویرایش کنید.':
          $this->adsEditGalleryStore($t, $u, $m);
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
       case 'لطفا عکس ها را ارسال کنید.':
        $this->adsCreateGalleryStore($t, $u, $m);
        break;
       default:
        $t->deleteMessage([
                           'chat_id' => $u->getChat()->id,
                           'message_id' => $m->messageId,
                          ]);
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
     case 'adsCreateFinish':
      $this->adsCreateFinish($t, $u, $m);
      break;
     case 'adsCreateReset':
      $this->adsCreateReset($t, $u, $m);
      break;
     case 'adsCreateTitleRequest':
      $this->adsCreateTitleRequest($t, $u, $m);
      break;
     case 'adsCreateStateRequest':
      $this->adsCreateStateRequest($t, $u, $m);
      break;
     case 'adsCreateCityRequest':
      $this->adsCreateCityRequest($t, $u, $m);
      break;
     case 'adsCreateContentRequest':
      $this->adsCreateContentRequest($t, $u, $m);
      break;
     case 'adsCreatePriceRequest':
      $this->adsCreatePriceRequest($t, $u, $m);
      break;
     case 'adsCreateCategoryRequest':
      $this->adsCreateCatgoryRequest($t, $u, $m);
      break;
     case 'adsCreateGalleryRequest':
      $this->adsCreateGalleryRequest($t, $u, $m);
      break;
     case 'adsEditTitleRequest':
      $this->adsEditTitleRequest($t, $u, $m);
      break;
     case 'adsEditStateRequest':
      $this->adsEditStateRequest($t, $u, $m);
      break;
     case 'adsEditCityRequest':
      $this->adsEditCityRequest($t, $u, $m);
      break;
     case 'adsEditContentRequest':
      $this->adsEditContentRequest($t, $u, $m);
      break;
     case 'adsEditPriceRequest':
      $this->adsEditPriceRequest($t, $u, $m);
      break;
     case 'adsEditCategoryRequest':
      $this->adsEditCatgoryRequest($t, $u, $m);
      break;
     case 'adsEditGalleryRequest':
      $this->adsEditGalleryRequest($t, $u, $m);
      break;
     case 'register':
      $this->register($t, $u, $m);
      break;
     case 'adsAcceptTheRules':
      $this->adsAcceptTheRules($t, $u, $m);
     default:
      $d = $cq->data;
      $s = Str::of($d);
      switch (true) {
       case $s->is('adsListPage*') :
        $this->adsList($t, $u, $m, (int)Str::after($d, 'adsListPage'));
        break;
       case $s->is('adsEdit*') :
        $this->adsEdit($t, $u, $m, (int)Str::after($d, 'adsEdit'));
        break;
       case $s->is('adsEditDelete*') :
        $this->adsEditDelete($t, $u, $m, (int)Str::after($d, 'adsEditDelete'));
        break;
       case $s->is('adsEditStateStore*') :
        $this->adsEditStateStore($t, $u, $m, (int)Str::after($d, 'adsEditStateStore'));
        break;
       case $s->is('adsEditCityStore*') :
        $this->adsEditCityStore($t, $u, $m, (int)Str::after($d, 'adsEditCityStore'));
        break;
       case $s->is('adsEditCategoryRequest*') :
        $this->adsEditCatgoryRequest($t, $u, $m, (int)Str::after($d, 'adsEditCategoryRequest'));
        break;
       case $s->is('adsEditCategoryStore*') :
        $this->adsEditCategoryStore($t, $u, $m, (int)Str::after($d, 'adsEditCategoryStore'));
        break;
       case $s->is('adsCreateStateStore*') :
        $this->adsCreateStateStore($t, $u, $m, (int)Str::after($d, 'adsCreateStateStore'));
        break;
       case $s->is('adsCreateCityStore*') :
        $this->adsCreateCityStore($t, $u, $m, (int)Str::after($d, 'adsCreateCityStore'));
        break;
       case $s->is('adsCreateCategoryRequest*') :
        $this->adsCreateCatgoryRequest($t, $u, $m, (int)Str::after($d, 'adsCreateCategoryRequest'));
        break;
       case $s->is('adsCreateCategoryStore*') :
        $this->adsCreateCategoryStore($t, $u, $m, (int)Str::after($d, 'adsCreateCategoryStore'));
        break;
      }
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

