<?php

namespace App\Http\Controllers\TelegramController;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Objects\Update;

trait Methods
{
 //methods
 public function updateLastMessage(string $text = null): void
 {
  auth()
   ->user()
   ->update([
             'telegram_last_message' => $text,
            ]);
 }

 public function getLastMessage()
 {
  return auth()->user()->telegram_last_message;
 }

 public function updateLastMessageId($id = null): void
 {
  auth()
   ->user()
   ->update([
             'telegram_last_message_id' => $id,
            ]);
 }

 public function getLastMessageId()
 {
  return auth()->user()->telegram_last_message_id;
 }

 public function deleteMessageClinet(Api $t, Update $u): void
 {
  $t->deleteMessage([
                     'chat_id' => $u->getChat()->id,
                     'message_id' => $u->getMessage()->messageId,
                    ]);
 }

 public function login(mixed $from): void
 {
  auth()->login(User::firstOrCreate(['telegram_id' => $from->id], [
   'name' => $from->firstName . ' ' . $from->lastName . 'telegram',
   'email' => $from->username . '@telegram.telegram',
   'telegram_first_name' => $from->firstName,
   'telegram_last_name' => $from->lastName,
   'telegram_username' => $from->username,
  ]));
 }

 public function deleteLastMessage(Api $t, Update $u): void
 {
  $telegramLastMessageId = $this->getLastMessageId();
  if ($telegramLastMessageId) {
   $t->deleteMessage([
                      'chat_id' => $u->getChat()->id,
                      'message_id' => $telegramLastMessageId,
                     ]);
  }
 }

 public function pagination(Collection|array $ads, int $adsCount, int $perPage, mixed $page, Keyboard $keyboard): void
 {
  $pagination = new LengthAwarePaginator($ads, $adsCount, $perPage, $page, [
   'path' => '',
   'pageName' => ''
  ]);
  if ($pagination->hasPages()) {
   $paginationInlineButton = $pagination->linkCollection()
                                        ->reject(function ($item) {
                                         return $item['url'] == null;
                                        })
                                        ->map(function ($item) {
                                         $pageNumber = \Str::of($item['url'])
                                                           ->after('?=');
                                         $label = $item['label'];
                                         $x = \Str::of($label);
                                         !$x->contains("Next") ?: $label = '▶';
                                         !$x->contains("Previous") ?: $label = '◀';
                                         $params = [
                                          'text' => $label . ($item['active'] === true ? '✅' : ''),
                                          'callback_data' => 'adsListPage' . $pageNumber
                                         ];
                                         return Keyboard::inlineButton($params);
                                        })
                                        ->toArray();
   $keyboard->row(...$paginationInlineButton);
  }
 }
}