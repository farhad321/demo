<?php

namespace App\Http\Controllers\TelegramController\Ads\CreateFields;

use Illuminate\Support\Collection;
use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Objects\EditedMessage;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\Update;

trait Content
{
 public function adsCreateContentRequest(Api $t, Update $u, Message|Collection|EditedMessage $m): void
 {
  $b = Keyboard::inlineButton([
                               'text' => 'بازگشت',
                               'callback_data' => 'adsCreate'
                              ]);
  $keyboard = Keyboard::make()
                      ->inline()
                      ->row($b);
  $text = 'لطفا متن آگهی را وارد کنید';
  $r = $t->editMessageText([
                            'chat_id' => $u->getChat()->id,
                            'message_id' => $this->getLastMessageId(),
                            'text' => $text,
                            'reply_markup' => $keyboard
                           ]);
  $this->updateLastMessage($text);
 }

 public function adsCreateContentStore(Api $t, Update $u, Message|Collection|EditedMessage $m): void
 {
  $this->updateUserExtra(function ($x) use ($m) {
   $x->adsCreate->content = $m->text;
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