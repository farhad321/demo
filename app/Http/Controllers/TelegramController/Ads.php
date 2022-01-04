<?php

namespace App\Http\Controllers\TelegramController;

use App\Models\Ad\Ad;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Button;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Objects\EditedMessage;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\Update;

trait Ads
{
 public function adsList(Api $t, Update $u, Message|Collection|EditedMessage $m)
 {
  $whereUserId = Ad::whereUserId(6);
  $adsCount = $whereUserId->count();
  $page = 2;
  $perPage = 2;
  $ads = $whereUserId->forPage($page, $perPage)
                     ->get();
  $keyboard = Keyboard::make()
                      ->inline();
  $inlineButton = Keyboard::inlineButton([
                                          'text' => 'ثبت آگهی',
                                          'callback_data' => 'adsCreate'
                                         ]);
  $keyboard->row(...[$inlineButton]);
  $response = $t->sendMessage([
                               'chat_id' => $u->getChat()->id,
                               'text' => 'به کیوسک خوش آمدید.',
                               'reply_markup' => $keyboard
                              ]);
  $pagination = new LengthAwarePaginator($ads, $adsCount, $perPage, $page, [
   'path' => '',
   'pageName' => ''
  ]);
  $pagination->linkCollection()
             ->each(function ($item) {
             });
 }
}