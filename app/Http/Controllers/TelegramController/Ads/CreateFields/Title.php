<?php

namespace App\Http\Controllers\TelegramController\Ads\CreateFields;

use App\Models\Ad\Ad;
use Illuminate\Support\Collection;
use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Objects\EditedMessage;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\Update;

trait Title
{
 public function adsCreateTitleRequest(Api $t, Update $u, Message|Collection|EditedMessage $m): void
 {
  $keyboard = Keyboard::make()
                      ->inline()
                      ->row(Keyboard::inlineButton([
                                                    'text' => 'بازگشت',
                                                    'callback_data' => 'adsCreate'
                                                   ]));
  $text = 'لطفا عنوان آگهی را ارسال کنید';
  $r = $t->editMessageText([
                            'chat_id' => $u->getChat()->id,
                            'message_id' => $this->getLastMessageId(),
                            'text' => $text,
                            'reply_markup' => $keyboard
                           ]);
  $this->updateLastMessage($text);
 }

 public function adsCreateTitleStore(Api $t, Update $u, Message|Collection|EditedMessage $m): void
 {
  $this->updateUserExtra(function ($x) use ($m) {
   $x->adsCreate->title = $m->text;
   return $x;
  });
  $t->deleteMessage([
                     'chat_id' => $u->getChat()->id,
                     'message_id' => $m->messageId,
                    ]);
  $this->adsCreate($t, $u);
  $this->updateLastMessage();
 }
}