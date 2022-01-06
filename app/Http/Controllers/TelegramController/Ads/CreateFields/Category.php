<?php

namespace App\Http\Controllers\TelegramController\Ads\CreateFields;

use Illuminate\Support\Collection;
use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Objects\EditedMessage;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\Update;

trait Category
{
 public function adsCreateCategoryRequest(Api $t, Update $u, Message|Collection|EditedMessage $m,
                                              $parenCategory = null): void
 {
  $text = 'لطفا دسته بندی را انتخاب کنید';
  $r = $t->editMessageText([
                            'chat_id' => $u->getChat()->id,
                            'message_id' => $this->getLastMessageId(),
                            'text' => $text,
                            'reply_markup' => $this->adsCreateCategoryRequestKeyboard($parenCategory)
                           ]);
 }

 public function adsCreateCategoryStore(Api $t, Update $u, Message|Collection|EditedMessage $m, $categoryId): void
 {
  $this->updateUserExtra(function ($x) use ($m, $categoryId) {
   $x->adsCreate->category_id = $categoryId;
   return $x;
  });
  $this->adsCreate($t, $u);
 }

 public function adsCreateCategoryRequestKeyboard($parenCategory): Keyboard
 {
  $keyboard = Keyboard::make()
                      ->inline();
  \App\Models\Ad\Category::whereParentId($parenCategory)
                         ->withCount('children')
                         ->get()
                         ->each(function ($item) use ($keyboard, $parenCategory) {
                          $b = Keyboard::inlineButton([
                                                       'text' => $item->name . ($item->children_count ? '◀' : ''),
                                                       'callback_data' => ($item->children_count ? 'adsCreateCategoryRequest' : 'adsCreateCategoryStore') . $item->id
                                                      ]);
                          $keyboard->row($b);
                         });
//  if ($parenCategory !==null) {
//   $b = Keyboard::inlineButton([
//                                'text' => 'متفرقه',
//                                'callback_data' => 'adsCreateCategoryStore' . $parenCategory
//                               ]);
//   $keyboard = $keyboard->row($b);
//  }
  $b = Keyboard::inlineButton([
                               'text' => 'بازگشت',
                               'callback_data' => 'adsCreate'
                              ]);
  $keyboard = $keyboard->row($b);
  return $keyboard;
 }
}