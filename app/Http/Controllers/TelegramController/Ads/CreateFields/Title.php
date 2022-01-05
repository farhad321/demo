<?php

namespace App\Http\Controllers\TelegramController\Ads\CreateFields;

use Illuminate\Support\Collection;
use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Objects\EditedMessage;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\Update;

trait Title
{
 //profile name
// public function profileFullNameRequest(Api $t, Update $u, Message|Collection|EditedMessage $m): void
// {
//  $keyboard = Keyboard::make()
//                      ->inline()
//                      ->row(Keyboard::inlineButton([
//                                                    'text' => 'بازگشت',
//                                                    'callback_data' => 'profile'
//                                                   ]));
//  $text = 'لطفا نام جدید خود را ارسال کنید';
//  $r = $t->editMessageText([
//                            'chat_id' => $u->getChat()->id,
//                            'message_id' => $this->getLastMessageId(),
//                            'text' => $text,
//                            'reply_markup' => $keyboard
//                           ]);
//  $this->updateLastMessage($text);
// }
//
// public function profileFullNameStore(Api $t, Update $u, Message|Collection|EditedMessage $m): void
// {
//  auth()
//   ->user()
//   ->update(['name' => $m->text]);
//  $t->deleteMessage([
//                     'chat_id' => $u->getChat()->id,
//                     'message_id' => $m->messageId,
//                    ]);
//  $this->profile($t, $u);
//  $this->updateLastMessage();
// }
}