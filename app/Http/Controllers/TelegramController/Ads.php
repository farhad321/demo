<?php

namespace App\Http\Controllers\TelegramController;

use App\Models\Ad\Ad;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Psy\Util\Str;
use stdClass;
use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Button;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Objects\EditedMessage;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\Update;
use Create;
use Edit;

trait Ads
{
 use Create, Edit;

 public function adsList(Api $t, Update $u, Message|Collection|EditedMessage $m, $page = 1)
 {
  $whereUserId = Ad::whereUserId(6);
  $adsCount = $whereUserId->count();
  $perPage = 5;
  $ads = $whereUserId->forPage($page, $perPage)
                     ->get();
  $keyboard = Keyboard::make()
                      ->inline();
  $ads->each(function ($ad) use ($keyboard) {
   $inlineButton = Keyboard::inlineButton([
                                           'text' => $ad->title,
                                           'callback_data' => 'adsEdit' . $ad->id
                                          ]);
   $keyboard->row($inlineButton);
  });
  $this->pagination($ads, $adsCount, $perPage, $page, $keyboard);
  $inlineButton = Keyboard::inlineButton([
                                          'text' => 'بازگشت',
                                          'callback_data' => 'startBack'
                                         ]);
  $keyboard->row($inlineButton);
  $response = $t->editMessageText([
                                   'chat_id' => $u->getChat()->id,
                                   'message_id' => $this->getLastMessageId(),
                                   'text' => $adsCount ? 'آگهی های شما' : 'شما هنوز هیچ آگهی ثبت نکرده اید.',
                                   'reply_markup' => $keyboard
                                  ]);
 }

 public function adsCreate(Api $t, Update $u): void
 {
  if (!isset(auth()->user()->extra->adsAcceptTheRulesMessageId)) {
   $this->adsAcceptTheRules($t, $u);
   return;
  }
  $user = auth()->user();
  $x = $user->extra ?? new stdClass();
  if (!isset($x->adsCreateNewAd)) {
   $x->adsCreateNewAd = new Ad();
  }
  $user->update(['extra' => $x,]);
  $r = $t->editMessageText([
                            'chat_id' => $u->getChat()->id,
                            'message_id' => $this->getLastMessageId(),
                            'text' => 'ایجاد آگهی جدید',
                            'reply_markup' => $this->adsCreateKeyboard()
                           ]);
 }

 public function adsCreateKeyboard(): Keyboard
 {
  /**
   * @var $newAd Ad
   * */
  $newAd = auth()->user()->extra->adsCreateNewAd;
  $inlineButton = Keyboard::inlineButton([
                                          'text' => $newAd->title ?? '❌',
                                          'callback_data' => 'profileFullNameRequest'
                                         ]);
  $inlineButton1 = Keyboard::inlineButton([
                                           'text' => 'عنوان',
                                           'callback_data' => 'profileFullNameRequest'
                                          ]);
  $inlineButton2 = Keyboard::inlineButton([
                                           'text' => $newAd->content ?? '❌',
                                           'callback_data' => 'profileFullNameRequest'
                                          ]);
  $inlineButton3 = Keyboard::inlineButton([
                                           'text' => 'متن',
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
                                           'text' => 'عکس ',
                                           'callback_data' => 'profileAvatarRequest'
                                          ]);
  $inlineButton7 = Keyboard::inlineButton([
                                           'text' => 'بازگشت',
                                           'callback_data' => 'startBack'
                                          ]);
  $inlineButton6 = Keyboard::inlineButton([
                                           'text' => $newAd->city->name ?? '❌',
                                           'callback_data' => 'profileFullNameRequest'
                                          ]);
  $inlineButton8 = Keyboard::inlineButton([
                                           'text' => 'شهر',
                                           'callback_data' => 'profileFullNameRequest'
                                          ]);
  $inlineButton9 = Keyboard::inlineButton([
                                           'text' => $newAd->state->name ?? '❌',
                                           'callback_data' => 'profileFullNameRequest'
                                          ]);
  $inlineButton10 = Keyboard::inlineButton([
                                            'text' => 'استان',
                                            'callback_data' => 'profileFullNameRequest'
                                           ]);
  return Keyboard::make()
                 ->inline()
                 ->row($inlineButton, $inlineButton1)
                 ->row($inlineButton2, $inlineButton3)
                 ->row($inlineButton4, $inlineButton5)
                 ->row($inlineButton6, $inlineButton8, $inlineButton9, $inlineButton10)
                 ->row($inlineButton7);
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

 public function adsAcceptTheRules(Api $t, Update $u): void
 {
  $r = $t->sendMessage([
                        'chat_id' => $u->getChat()->id,
                        'message_id' => $this->getLastMessageId(),
                        'text' => 'قوانین ثبت آگهی
چنانچه از ناحیه مراجع ذیصلاح قانونی دستور حذف آگهی صادر شده باشد، Kiusk.ca فوراً اقدام به حذف آگهی می‌نماید. همچنین در صورتی که گزارش تخلف کاربران نسبت به آگهی بیشتر از 5 مورد باشد، (Kiusk.ca (Kiusk Group Ltd به صلاحدید خود ممکن است اقدام به حذف آگهی نماید. در دو فرض اخیر  (Kiusk.ca (Kiusk Group Ltd هیچ‌گونه مسئولیتی بابت آگهی حذف شده به کاربران ندارد.

آگهی‌دهندگان با ثبت آگهی خود در (Kiusk.ca (Kiusk Group Ltd تأیید می‌کنند که آگهی ایشان شامل مواردی که در ادامه آورده می‌شوند نخواهد بود و همچنین دارای سن بالای ۱۸ سال هستند.

 ✔️ مغایرت با کشور کانادا و عرف جامعه،
 ✔️ هرگونه محتوای مندرج در فهرست مصادیق محتوای مجرمانه،
 ✔️ ناقض حریم شخصی افراد،
 ✔️ استفاده از عبارت‌ها یا کلمات نامرتبط با اگهی.
 ✔️ درج قیمت در عنوان آگهی.
 ✔️ آگهی‌های  بدون تصویر در تمامی سایت .


✅ هر گونه توهین به ادیان ، آداب، رسوم، قومیت‌ها، لهجه‌ها و گویش‌های مختلف،

✅ حاوی متن غیر مرتبط با اگهی ملک.

✅ استفاده ابزاری از تصاویر اشخاص در آگهی، درج بی‌مورد عکس صورت اشخاص

✅ هر نوع آگهی و خبرپراکنی سیاسی، اجتماعی یا مذهبی که جنبه تجاری نداشته باشد،

✅ درج شماره حساب یا حساب بانکی در متن آگهی،

✅ خدمات و کالاهایی که شائبه کلاهبرداری در آن مشاهده شود.

✅درج مکرر آگهی‌‌های یکسان حتی با عناوین متفاوت در یک روز.

✅ ارسال مجدد یک آگهی‌‌ که از زمان حذف آن توسط کاربر، بیش از ۲۴ ساعت سپری نشده باشد.

✅ هرگونه به شبکه‌های اجتماعی مانند تلگرام و یا اینستاگرام در بخش توضیحات 

✅ درج سامانه پیامکی در متن آگهی.

✅ وجود جملات نادرست از نظر املائی یا نگارشی در متن اگهی و یا  عنوان اگهی .

✅هر اگهی نامفهوم و غلط و یا گمراه کننده

✅ هر اگهی که سرور یا کدنویسی سایت را به هر علتی مشکل مواجه کند. 

✅ هر اگهی که عنوانش فارسی نباشد.

✅ هر اگهی که در دسته بندی نامناسب درج شده باشد

✅ هر اگهی که مربوط به خارج از کانادا باشد.

✅ هر اگهی با ایمیل ادرس ها و اکانت های مختلف.

✅  هر اگهی که شامل کلمات کلیدی میباشد که با اگهی مرتبط نمی باشد.

✅ هر اگهی که مالکیت ، فروش ،خرید ان غیر قانونی میباشد.

✅ درج مکرر آگهی‌‌های  یکسان  که در چند دسته بندی مختلف درج شده باشد.

✅  درج  اگهی که ترافیک سایت را به ادرس دیگری هدایت کند.

 هرگونه سوءاستفاده از شماره تلفن همراه یا نشانی پست الکترونیکی دیگران پیگرد قانونی دارد و آگهی دهنده مسئول آن تلقی شده و Kiusk.ca در این مورد هیچ گونه مسئولیتی     ندارد.

اکانت شما 

جهت استفاده از وبسایت Kiusk.ca)Kiusk group ltd) شما ممکن است نیاز به  داشتن اکانت و ثبت نام با ایمیل ادرس و رمز عبور باشید ،ایمیل ادرس ارایه شده ایمیل ادرس شماست و شما شخصا مسعولیت حفظ و نگهداری رمز عبور شخصی و تمامی فعالیت های اکانت خود را دارید،در نتیجه شما باید از رمز عبور (گذرواژه)  خود نهایت مراقبت را انجام دهید و گذرواژه ایی انتخاب نمایید که قابل حدس زدن نباشد.

شما ممکن است به یک سرویس،توسط سرویسشخص ثالث ( third-party) وصل شوید که به ما اجازه دسترسی ذخیره ،و یا استفاده از ان سرویس ، توسط مجوزی که شما به ان سرویس داده است.

اگر شما فکر میکنید اکانت شما مورد خطر قرار گرفته و یا استفاده نابجا  شده از طریق ایمیل info@Kiusk.ca با ما مکاتبه کنید.',
                        'reply_markup' => Keyboard::make()
                                                  ->inline()
                                                  ->row(Keyboard::inlineButton([
                                                                                'text' => 'قبول قوانین',
                                                                                'callback_data' => 'adsCreate'
                                                                               ]))
                       ]);
  $user = auth()->user();
  $x = $user->extra ?? new stdClass();
  $x->adsAcceptTheRulesMessageId = $r->messageId;
  $user->update(['extra' => $x,]);
 }

 public function adsAcceptTheRulesConfirmation(Api $t, Update $u)
 {
  //پیام ربات
  if (isset(auth()->user()->extra->adsAcceptTheRulesMessageId)) {
   $t->deleteMessage([
                      'chat_id' => $u->getChat()->id,
                      'message_id' => auth()->user()->extra->adsAcceptTheRulesMessageId,
                     ]);
  }
  $this->adsCreate($t, $u);
 }
}