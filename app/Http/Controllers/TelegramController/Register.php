<?php

namespace App\Http\Controllers\TelegramController;

use Illuminate\Support\Collection;
use stdClass;
use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Objects\EditedMessage;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\Update;

trait Register
{
 public function register(Api $t, Update $u): void
 {
  $buttons = Keyboard::button([
                               'text' => 'ارسال شماره تلفن',
                               'request_contact' => true,
                              ]);
  $buttons1 = Keyboard::button([
                                'text' => 'بازگشت',
                               ]);
  $keyboard = Keyboard::make()
                      ->row($buttons)
                      ->row($buttons1);
  $text = 'شماره تلفن خود را تایید کنید.';
  $r = $t->sendMessage([
                        'chat_id' => $u->getChat()->id,
                        'message_id' => $this->getLastMessageId(),
                        'text' => $text,
                        'reply_markup' => $keyboard
                       ]);
  $this->updateLastMessage($text);
  $field = 'registerMessageId';
  $value = $r->messageId;
  $user = auth()->user();
  $x = $user->extra ?? new stdClass();
  $x->{$field} = $value;
  $user->update(['extra' => $x,]);
 }

 public function registerStore(Api $t, Update $u, Message|Collection|EditedMessage $m): void
 {
  auth()
   ->user()
   ->update(['phone' => $m->contact->phoneNumber]);
  //پیام ربات
  $registerMessageId = auth()->user()->extra->registerMessageId;
  if ($registerMessageId) {
   $t->deleteMessage([
                      'chat_id' => $u->getChat()->id,
                      'message_id' => $registerMessageId,
                     ]);
  }
  //شماره تلفن
  $t->deleteMessage([
                     'chat_id' => $u->getChat()->id,
                     'message_id' => $m->messageId,
                    ]);
  $this->updateLastMessage();
 }
}