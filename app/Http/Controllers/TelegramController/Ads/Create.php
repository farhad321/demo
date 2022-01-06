<?php

namespace App\Http\Controllers\TelegramController\Ads;

use App\Http\Controllers\TelegramController\Ads\CreateFields\Category;
use App\Http\Controllers\TelegramController\Ads\CreateFields\City;
use App\Http\Controllers\TelegramController\Ads\CreateFields\Content;
use App\Http\Controllers\TelegramController\Ads\CreateFields\Gallery;
use App\Http\Controllers\TelegramController\Ads\CreateFields\State;
use App\Http\Controllers\TelegramController\Ads\CreateFields\Title;
use App\Http\Controllers\TelegramController\Methods;
use App\Models\Ad\Ad;
use stdClass;
use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Objects\Update;

trait Create
{
 use Title, Content, State, City, Gallery, Category, Methods;

 public function adsCreate(Api $t, Update $u): void
 {
  if (!isset(auth()->user()->extra->adsAcceptTheRulesMessageId)) {
   $this->adsAcceptTheRules($t, $u);
   return;
  };
  $this->updateUserExtra(function ($x) {
   if (!isset($x->adsCreate)) {
    $x->adsCreate = new stdClass();
   }
   return $x;
  });
  $r = $t->editMessageText([
                            'chat_id' => $u->getChat()->id,
                            'message_id' => $this->getLastMessageId(),
                            'text' => 'ایجاد آگهی جدید' . $this->flashMassage(),
                            'reply_markup' => $this->adsCreateKeyboard()
                           ]);
 }

 public function adsCreateKeyboard(): Keyboard
 {
  /**
   * @var $newAd Ad
   * */
  $newAd = auth()->user()->extra->adsCreate;
  $b_1 = Keyboard::inlineButton([
                                 'text' => isset($newAd->category_id) ? \App\Models\Ad\Category::find($newAd->category_id)->name : '❌',
                                 'callback_data' => 'adsCreateCategoryRequest'
                                ]);
  $b1_1 = Keyboard::inlineButton([
                                  'text' => 'دسته بندی',
                                  'callback_data' => 'adsCreateCategoryRequest'
                                 ]);
  $b = Keyboard::inlineButton([
                               'text' => $newAd->title ?? '❌',
                               'callback_data' => 'adsCreateTitleRequest'
                              ]);
  $b1 = Keyboard::inlineButton([
                                'text' => 'عنوان',
                                'callback_data' => 'adsCreateTitleRequest'
                               ]);
  $b2 = Keyboard::inlineButton([
                                'text' => $newAd->content ?? '❌',
                                'callback_data' => 'adsCreateContentRequest'
                               ]);
  $b3 = Keyboard::inlineButton([
                                'text' => 'متن',
                                'callback_data' => 'adsCreateContentRequest'
                               ]);
  $count = auth()
   ->user()
   ->getMedia('adsCreateGallery')
   ->count();
  $b4 = Keyboard::inlineButton([
                                'text' => $count ? "تعداد عکس ها: " . $count . '✅' : '❌',
                                'callback_data' => 'adsCreateGalleryRequest'
                               ]);
  $b5 = Keyboard::inlineButton([
                                'text' => 'عکس ها ',
                                'callback_data' => 'adsCreateGalleryRequest'
                               ]);
  $b6 = Keyboard::inlineButton([
                                'text' => isset($newAd->city_id) ? \App\Models\Address\City::find($newAd->city_id)->name : '❌',
                                'callback_data' => 'adsCreateCityRequest'
                               ]);
  $b8 = Keyboard::inlineButton([
                                'text' => 'شهر',
                                'callback_data' => 'adsCreateCityRequest'
                               ]);
  $b9 = Keyboard::inlineButton([
                                'text' => isset($newAd->state_id) ? \App\Models\Address\State::find($newAd->state_id)->name : '❌',
                                'callback_data' => 'adsCreateStateRequest'
                               ]);
  $b10 = Keyboard::inlineButton([
                                 'text' => 'استان',
                                 'callback_data' => 'adsCreateStateRequest'
                                ]);
  $b7 = Keyboard::inlineButton([
                                'text' => 'بازگشت',
                                'callback_data' => 'startBack'
                               ]);
  return Keyboard::make()
                 ->inline()
                 ->row($b_1, $b1_1)
                 ->row($b, $b1)
                 ->row($b2, $b3)
                 ->row($b4, $b5)
                 ->row($b6, $b8, $b9, $b10)
                 ->row($b7);
 }
}