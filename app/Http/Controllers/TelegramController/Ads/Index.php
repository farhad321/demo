<?php

namespace App\Http\Controllers\TelegramController\Ads;

use App\Models\Ad\Ad;
use Illuminate\Support\Collection;
use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Objects\EditedMessage;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\Update;

trait Index
{
 public function adsList(Api $t, Update $u, Message|Collection|EditedMessage $m, $page = 1)
 {
  $whereUserId = Ad::whereUserId(2);
  $adsCount = $whereUserId->count();
  $perPage = 5;
  $ads = $whereUserId->forPage($page, $perPage)
                     ->get();
  $keyboard = Keyboard::make()
                      ->inline();
  $ads->each(function ($ad) use ($keyboard) {
   $inlineButton = Keyboard::inlineButton([
                                           'text' => $ad->title,
                                           'callback_data' => 'adsEdit' . $ad->id
                                          ]);
   $keyboard->row($inlineButton);
  });
  $this->pagination($ads, $adsCount, $perPage, $page, $keyboard);
  $inlineButton = Keyboard::inlineButton([
                                          'text' => 'بازگشت',
                                          'callback_data' => 'startBack'
                                         ]);
  $keyboard->row($inlineButton);
  $response = $t->editMessageText([
                                   'chat_id' => $u->getChat()->id,
                                   'message_id' => $this->getLastMessageId(),
                                   'text' => $adsCount ? 'آگهی های شما' : 'شما هنوز هیچ آگهی ثبت نکرده اید.',
                                   'reply_markup' => $keyboard
                                  ]);
 }
}