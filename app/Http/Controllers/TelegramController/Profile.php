<?php

namespace App\Http\Controllers\TelegramController;

use Illuminate\Support\Collection;
use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Objects\EditedMessage;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\Update;

trait Profile
{
 //profile
 public function profile(Api $t, Update $u): void
 {
  $r = $t->editMessageText([
                            'chat_id' => $u->getChat()->id,
                            'message_id' => $this->getLastMessageId(),
                            'text' => 'اطلاعات پروفایل شما :',
                            'reply_markup' => $this->profileKeyboard()
                           ]);
 }

 public function profileKeyboard(): Keyboard
 {
  $inlineButton = Keyboard::inlineButton([
                                          'text' => '❌',
                                          'callback_data' => 'profileRuleRequest'
                                         ]);
  $inlineButton1 = Keyboard::inlineButton([
                                           'text' => 'نوع اکانت',
                                           'callback_data' => 'profileRuleRequest'
                                          ]);
  $inlineButton2 = Keyboard::inlineButton([
                                           'text' => auth()->user()->name ?? '❌',
                                           'callback_data' => 'profileFullNameRequest'
                                          ]);
  $inlineButton3 = Keyboard::inlineButton([
                                           'text' => 'نام و نام خانوادگی',
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
                                           'text' => 'عکس پروفایل',
                                           'callback_data' => 'profileAvatarRequest'
                                          ]);
  $inlineButton6 = Keyboard::inlineButton([
                                           'text' => 'تغییر رمز عبور',
                                           'callback_data' => 'profilePasswordRequest'
                                          ]);
  $inlineButton7 = Keyboard::inlineButton([
                                           'text' => 'بازگشت',
                                           'callback_data' => 'startBack'
                                          ]);
  return Keyboard::make()
                 ->inline()
                 ->row($inlineButton, $inlineButton1)
                 ->row($inlineButton2, $inlineButton3)
                 ->row($inlineButton4, $inlineButton5)
                 ->row($inlineButton6)
                 ->row($inlineButton7);
 }

 //profile name
 public function profileFullNameRequest(Api $t, Update $u, Message|Collection|EditedMessage $m): void
 {
  $keyboard = Keyboard::make()
                      ->inline()
                      ->row(Keyboard::inlineButton([
                                                    'text' => 'بازگشت',
                                                    'callback_data' => 'profile'
                                                   ]));
  $text = 'لطفا نام جدید خود را ارسال کنید';
  $r = $t->editMessageText([
                            'chat_id' => $u->getChat()->id,
                            'message_id' => $this->getLastMessageId(),
                            'text' => $text,
                            'reply_markup' => $keyboard
                           ]);
  $this->updateLastMessage($text);
 }

 public function profileFullNameStore(Api $t, Update $u, Message|Collection|EditedMessage $m): void
 {
  auth()
   ->user()
   ->update(['name' => $m->text]);
  $t->deleteMessage([
                     'chat_id' => $u->getChat()->id,
                     'message_id' => $m->messageId,
                    ]);
  $this->profile($t, $u);
  $this->updateLastMessage();
 }

 //profile password
 public function profilePasswordRequest(Api $t, Update $u, Message|Collection|EditedMessage $m): void
 {
  $keyboard = Keyboard::make()
                      ->inline()
                      ->row(Keyboard::inlineButton([
                                                    'text' => 'بازگشت',
                                                    'callback_data' => 'profile'
                                                   ]));
  $text = 'لطفا رمز عبور جدید خود را ارسال کنید';
  $r = $t->editMessageText([
                            'chat_id' => $u->getChat()->id,
                            'message_id' => $this->getLastMessageId(),
                            'text' => $text,
                            'reply_markup' => $keyboard
                           ]);
  $this->updateLastMessage($text);
 }

 public function profilePasswordStore(Api $t, Update $u, Message|Collection|EditedMessage $m): void
 {
  auth()
   ->user()
   ->update(['password' => bcrypt($m->text)]);
  $t->deleteMessage([
                     'chat_id' => $u->getChat()->id,
                     'message_id' => $m->messageId,
                    ]);
  $this->profile($t, $u);
  $this->updateLastMessage();
 }

 //profile avatar
 public function profileAvatarRequest(Api $t, Update $u, Message|Collection|EditedMessage $m): void
 {
  $keyboard = Keyboard::make()
                      ->inline()
                      ->row(Keyboard::inlineButton([
                                                    'text' => 'بازگشت',
                                                    'callback_data' => 'profile'
                                                   ]));
  $text = 'لطفا عکس پروفایل خود را ارسال کنید';
  $r = $t->editMessageText([
                            'chat_id' => $u->getChat()->id,
                            'message_id' => $this->getLastMessageId(),
                            'text' => $text,
                            'reply_markup' => $keyboard
                           ]);
  $this->updateLastMessage($text);
 }

 public function profileAvatarStore(Api $t, Update $u, Message|Collection|EditedMessage $m): void
 {
  $file = $t->getFile([
                       'file_id' => $m->photo[0]['file_id'],
                      ]);
  $fileUrl = 'http://api.telegram.org/file/bot' . config('telegram.bots.mybot.token') . '/' . $file->filePath;
  dump($m->photo, gettype($m->photo[0]), $file, $fileUrl);
//  sleep(5);
  $filename = 'temp-image.jpg';
  $tempImage = tempnam(sys_get_temp_dir(), $filename);
  copy($fileUrl, $tempImage);
  auth()
   ->user()
   ->addMedia($tempImage)
//   ->addMediaFromUrl($fileUrl)
   ->toMediaCollection('avatar');
  $t->deleteMessage([
                     'chat_id' => $u->getChat()->id,
                     'message_id' => $m->messageId,
                    ]);
  $this->profile($t, $u);
  $this->updateLastMessage();
 }
}