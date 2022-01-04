<?php

namespace App\Http\Controllers\TelegramController;

use Telegram\Bot\Api;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Objects\Update;

trait Start
{
 //start
 public function start(Api $t, Update $u): void
 {
  $t->sendPhoto([
                 'chat_id' => $u->getChat()->id,
                 'photo' => InputFile::create(public_path('4611.png'), 'welcome.png'),
                ]);
  $response = $t->sendMessage([
                               'chat_id' => $u->getChat()->id,
                               'text' => 'به کیوسک خوش آمدید.',
                               'reply_markup' => $this->startKeyboard()
                              ]);
  $this->updateLastMessageId($response->messageId);
 }

 public function startBack(Api $t, Update $u): void
 {
  $response = $t->editMessageText([
                                   'chat_id' => $u->getChat()->id,
                                   'message_id' => $this->getLastMessageId(),
                                   'text' => 'به کیوسک خوش آمدید.',
                                   'reply_markup' => $this->startKeyboard()
                                  ]);
 }

 public function startKeyboard(): Keyboard
 {
  $inlineButton = Keyboard::inlineButton([
                                          'text' => 'ثبت آگهی',
                                          'callback_data' => 'adsCreate'
                                         ]);
  $inlineButton1 = Keyboard::inlineButton([
                                           'text' => (auth()->user()->phone ? '✅' : '❌') . ' ثبت نام',
                                           'callback_data' => 'register'
                                          ]);
  $inlineButton2 = Keyboard::inlineButton([
                                           'text' => 'آگهی های من',
                                           'callback_data' => 'adsList'
                                          ]);
  $inlineButton3 = Keyboard::inlineButton([
                                           'text' => 'پروفایل من',
                                           'callback_data' => 'profile'
                                          ]);
  $keyboard = Keyboard::make()
                      ->inline()
                      ->row($inlineButton, $inlineButton1)
                      ->row($inlineButton2, $inlineButton3);
  return $keyboard;
 }
}