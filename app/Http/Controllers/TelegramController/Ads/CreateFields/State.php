<?php

namespace App\Http\Controllers\TelegramController\Ads\CreateFields;

use Illuminate\Support\Collection;
use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Objects\EditedMessage;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\Update;

trait State
{
 public function adsCreateStateRequest(Api $t, Update $u, Message|Collection|EditedMessage $m): void
 {
  $text = 'لطفا استان را انتخاب کنید';
  $r = $t->editMessageText([
                            'chat_id' => $u->getChat()->id,
                            'message_id' => $this->getLastMessageId(),
                            'text' => $text,
                            'reply_markup' => $this->adsCreateStateRequestKeyboard()
                           ]);
 }

 public function adsCreateStateStore(Api $t, Update $u, Message|Collection|EditedMessage $m, $stateId): void
 {
  $this->updateUserExtra(function ($x) use ($m, $stateId) {
   $x->adsCreate->state_id = $stateId;
   unset($x->adsCreate->city_id);
   return $x;
  });
  $this->adsCreate($t, $u);
 }

 public function adsCreateStateRequestKeyboard(): Keyboard
 {
  $keyboard = Keyboard::make()
                      ->inline();
  \App\Models\Address\State::all()
                           ->each(function ($ad) use ($keyboard) {
                            $inlineButton = Keyboard::inlineButton([
                                                                    'text' => $ad->name,
                                                                    'callback_data' => 'adsCreateStateStore' . $ad->id
                                                                   ]);
                            $keyboard->row($inlineButton);
                           });
  $b = Keyboard::inlineButton([
                               'text' => 'بازگشت',
                               'callback_data' => 'adsCreate'
                              ]);
  $keyboard = $keyboard->row($b);
  return $keyboard;
 }
}