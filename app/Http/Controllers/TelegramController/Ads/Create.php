<?php

namespace App\Http\Controllers\TelegramController\Ads;
use App\Http\Controllers\TelegramController\Ads\Fields\City;
use App\Http\Controllers\TelegramController\Ads\Fields\Content;
use App\Http\Controllers\TelegramController\Ads\Fields\Media;
use App\Http\Controllers\TelegramController\Ads\Fields\State;
use App\Http\Controllers\TelegramController\Ads\Fields\Title;
use App\Models\Ad\Ad;
use stdClass;
use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Objects\Update;

trait Create
{
 use Title, Content, State, City, Media;

 public function adsCreate(Api $t, Update $u): void
 {
  if (!isset(auth()->user()->extra->adsAcceptTheRulesMessageId)) {
   $this->adsAcceptTheRules($t, $u);
   return;
  }
  $user = auth()->user();
  $x = $user->extra ?? new stdClass();
  if (!isset($x->adsCreateNewAd)) {
   $x->adsCreateNewAd = new Ad();
  }
  $user->update(['extra' => $x,]);
  $r = $t->editMessageText([
                            'chat_id' => $u->getChat()->id,
                            'message_id' => $this->getLastMessageId(),
                            'text' => 'ایجاد آگهی جدید',
                            'reply_markup' => $this->adsCreateKeyboard()
                           ]);
 }

 public function adsCreateKeyboard(): Keyboard
 {
  /**
   * @var $newAd Ad
   * */
  $newAd = auth()->user()->extra->adsCreateNewAd;
  $inlineButton = Keyboard::inlineButton([
                                          'text' => $newAd->title ?? '❌',
                                          'callback_data' => 'profileFullNameRequest'
                                         ]);
  $inlineButton1 = Keyboard::inlineButton([
                                           'text' => 'عنوان',
                                           'callback_data' => 'profileFullNameRequest'
                                          ]);
  $inlineButton2 = Keyboard::inlineButton([
                                           'text' => $newAd->content ?? '❌',
                                           'callback_data' => 'profileFullNameRequest'
                                          ]);
  $inlineButton3 = Keyboard::inlineButton([
                                           'text' => 'متن',
                                           'callback_data' => 'profileFullNameRequest'
                                          ]);
  $inlineButton4 = Keyboard::inlineButton([
                                           'text' => auth()
                                            ->user()
                                            ->getMedia('avatar')
                                            ->count() ? '✅' : '❌',
                                           'callback_data' => 'profileAvatarRequest'
                                          ]);
  $inlineButton5 = Keyboard::inlineButton([
                                           'text' => 'عکس ',
                                           'callback_data' => 'profileAvatarRequest'
                                          ]);
  $inlineButton7 = Keyboard::inlineButton([
                                           'text' => 'بازگشت',
                                           'callback_data' => 'startBack'
                                          ]);
  $inlineButton6 = Keyboard::inlineButton([
                                           'text' => $newAd->city->name ?? '❌',
                                           'callback_data' => 'profileFullNameRequest'
                                          ]);
  $inlineButton8 = Keyboard::inlineButton([
                                           'text' => 'شهر',
                                           'callback_data' => 'profileFullNameRequest'
                                          ]);
  $inlineButton9 = Keyboard::inlineButton([
                                           'text' => $newAd->state->name ?? '❌',
                                           'callback_data' => 'profileFullNameRequest'
                                          ]);
  $inlineButton10 = Keyboard::inlineButton([
                                            'text' => 'استان',
                                            'callback_data' => 'profileFullNameRequest'
                                           ]);
  return Keyboard::make()
   ->inline()
   ->row($inlineButton, $inlineButton1)
   ->row($inlineButton2, $inlineButton3)
   ->row($inlineButton4, $inlineButton5)
   ->row($inlineButton6, $inlineButton8, $inlineButton9, $inlineButton10)
   ->row($inlineButton7);
 }
}