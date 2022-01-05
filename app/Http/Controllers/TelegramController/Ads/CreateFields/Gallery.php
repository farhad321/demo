<?php

namespace App\Http\Controllers\TelegramController\Ads\CreateFields;

use Illuminate\Support\Collection;
use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Objects\EditedMessage;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\Update;

trait Gallery
{
 public function adsCreateGalleryRequest(Api $t, Update $u, Message|Collection|EditedMessage $m): void
 {
  $b = Keyboard::inlineButton([
                               'text' => 'بازگشت',
                               'callback_data' => 'adsCreate'
                              ]);
  $keyboard = Keyboard::make()
                      ->inline()
                      ->row($b);
  $text = 'لطفا عکس ها را ارسال کنید.';
  $r = $t->editMessageText([
                            'chat_id' => $u->getChat()->id,
                            'message_id' => $this->getLastMessageId(),
                            'text' => $text,
                            'reply_markup' => $keyboard
                           ]);
  $this->updateLastMessage($text);
 }

 public function adsCreateGalleryStore(Api $t, Update $u, Message|Collection|EditedMessage $m): void
 {
  $user = auth()->user();
  $user->clearMediaCollection('adsCreateGallery');
  foreach ($m->photo as $item) {
   $file = $t->getFile([
                        'file_id' => $item['file_id'],
                       ]);
   $fileUrl = 'http://api.telegram.org/file/bot' . config('telegram.bots.mybot.token') . '/' . $file->filePath;
   $user
//   ->addMedia($tempImage)
    ->addMediaFromUrl($fileUrl)
    ->toMediaCollection('adsCreateGallery');
  }
  $t->deleteMessage([
                     'chat_id' => $u->getChat()->id,
                     'message_id' => $m->messageId,
                    ]);
  $this->adsCreate($t, $u);
  $this->updateLastMessage();
 }
}