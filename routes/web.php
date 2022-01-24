<?php

use App\Http\Controllers\Front\Ad\AdsController;
use App\Http\Controllers\Front\Blog\BlogController;
use App\Http\Controllers\Front\Home\HomeController;
use App\Http\Controllers\Front\Panel\User\UserPanelController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SeedController;
use App\Http\Controllers\SeedPostController;
use App\Http\Controllers\TelegramController;
use App\Models\Ad\Ad;
use App\Models\Ad\Category;
use App\Models\Blog\Post;
use App\Models\User;

//use Corcel\Model\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Telegram\Bot\Api;
use Telegram\Bot\Laravel\Facades\Telegram;

/**
 * @param $post
 * @return Closure
 */
//seed
Route::group(['as' => ''], function () {
 Route::get('seed/all', function () {
  (new SeedController())->adAll();
  (new SeedPostController())->postAll();
  return 'seed all successful';
 });
 Route::get('seed/ad/all', [
  SeedController::class,
  'adAll',
 ]);
 Route::get('seed/ads', [
  SeedController::class,
  'ads',
 ]);
 Route::get('seed/tags', [
  SeedController::class,
  'tags',
 ]);
 Route::get('seed/categories', [
  SeedController::class,
  'categories',
 ]);
 Route::get('seed/post/all', [
  SeedPostController::class,
  'postAll',
 ]);
 Route::get('seed/posts', [
  SeedPostController::class,
  'posts',
 ]);
 Route::get('seed/posts/tags', [
  SeedPostController::class,
  'tags',
 ]);
 Route::get('seed/posts/categories', [
  SeedPostController::class,
  'categories',
 ]);
});
//old Front
/*Route::group(['prefix' => ''], function () {
 //home
 Route::view('/', 'base')
      ->name('home');
 Route::get('product-category/{slug?}/page/{page?}', [
  PageController::class,
  'adCategory'
 ])

  //ads
      ->name('ads-category');
 Route::get('product-category/{slug?}', [
  PageController::class,
  'adCategory'
 ])
      ->name('index-ads-category');
 Route::get('product-tag/{slug?}/page/{page?}', [
  PageController::class,
  'adTag'
 ])
      ->name('ads-tag');
 Route::get('product-tag/{slug?}', [
  PageController::class,
  'adTag'
 ])
      ->name('index-ads-tag');
 Route::get('ads/{slug?}', [
  PageController::class,
  'ad'
 ])
      ->name('ad');
//blog
 Route::get('weblog-2/{page?}', [
  BlogController::class,
  'index'
 ])
      ->name('blog-index');
 Route::get('blog/{year}/{month}/{day}/{slug}', [
  BlogController::class,
  'post'
 ])
      ->name('blog-post');
 Route::get('tags/{slug?}', [
  BlogController::class,
  'tags'
 ])
      ->name('post-tags');
});*/
//new Front
Route::group([
              'as' => 'front.',
              'middleware' => 'cacheResponse'
             ], function () {
 Route::get('', [
  HomeController::class,
  'frontHome'
 ])
      ->middleware('cacheResponse')
      ->name('home');
 Route::get('login-register', [
  HomeController::class,
  'frontLoginRegister'
 ])
      ->name('login-register');
 Route::get('قوانین-و-مقررات', [
  HomeController::class,
  'frontRules'
 ])
      ->name('rules');
 Route::get('contact', [
  HomeController::class,
  'frontContactUs'
 ])
      ->name('contact-us');
 Route::get('about', [
  HomeController::class,
  'frontAboutUs'
 ])
      ->name('about-us');
 Route::group(['as' => 'ad.'], function () {
//  Route::get('', [
//   AdsController::class,
//   'frontAdSearch'
//  ])
//       ->name('search');
  Route::get('listing', [
   AdsController::class,
   'frontAdIndex'
  ])
       ->name('index.first.page');
  Route::get('listing/page/{page?}', [
   AdsController::class,
   'frontAdIndex'
  ])
       ->name('index');
  Route::get('newad', [
   AdsController::class,
   'frontAdCreate'
  ])
       ->name('create')
       ->middleware('auth');
  Route::get('ads/{slug?}', [
   AdsController::class,
   'frontAdShow'
  ])
       ->name('show');
  Route::group(['as' => 'category.city.'], function () {
   Route::get('blog/city_categories/{slug?}/page/{page?}', [
    AdsController::class,
    'frontAdCategoryCityIndex'
   ])
        ->name('index');
   Route::get('blog/city_categories/{slug?}', [
    AdsController::class,
    'frontAdCategoryCityIndex'
   ])
        ->name('index.first.page');
  });
  Route::group(['as' => 'category.'], function () {
   Route::get('product-category/{slug?}/page/{page?}', [
    AdsController::class,
    'frontAdCategoryIndex'
   ])
        ->name('index');
   Route::get('product-category/{slug?}', [
    AdsController::class,
    'frontAdCategoryIndex'
   ])
        ->name('index.first.page');
  });
  Route::group(['as' => 'tag.'], function () {
   Route::get('product-tag/{slug?}/page/{page?}', [
    AdsController::class,
    'frontAdTagIndex'
   ])
        ->name('index');
   Route::get('product-tag/{slug?}', [
    AdsController::class,
    'frontAdTagIndex'
   ])
        ->name('index.first.page');
  });
 });
 Route::group(['as' => 'blog.'], function () {
  Route::get('blog/{year}/{month}/{day}/{slug}', [
   BlogController::class,
   'frontBlogShow'
  ])
       ->name('show');
  Route::group(['as' => 'category.'], function () {
   Route::get('weblog-2/{page?}', [
    BlogController::class,
    'frontBlogCategoryIndexBlog'
   ])
        ->name('blog.index');
   Route::get('weblog-2', [
    BlogController::class,
    'frontBlogCategoryIndexBlog'
   ])
        ->name('blog.index.first.page');
   Route::get('اخبار/{page}', [
    BlogController::class,
    'frontBlogCategoryIndexNews'
   ])
        ->name('news.index');
   Route::get('اخبار', [
    BlogController::class,
    'frontBlogCategoryIndexNews'
   ])
        ->name('news.index.first.page');
  });
  Route::group(['as' => 'tag.'], function () {
   Route::get('tags/{slug}/page/{page}', [
    BlogController::class,
    'frontBlogTagIndex'
   ])
        ->name('index');
   Route::get('tags/{slug}', [
    BlogController::class,
    'frontBlogTagIndex'
   ])
        ->name('index.first.page');
  });
 });
 Route::group([
               'as' => 'panel.user.',
               'middleware' => 'auth'
              ], function () {
  Route::get('profile/{user?}', [
//  Route::get('profile/?user={user?}', [
   UserPanelController::class,
   'frontPanelUserProfileShow'
  ])
       ->name('profile.show');
  Route::group([
                'prefix' => 'my-account'
               ], function () {
   Route::get('', [
    UserPanelController::class,
    'frontPanelUserAdIndex'
   ])
        ->name('ad.index');
   Route::get('user-bookmark', [
    UserPanelController::class,
    'frontPanelUserFavoriteIndex'
   ])
        ->name('favorite.index');
   Route::get('orders', [
    UserPanelController::class,
    'frontPanelUserPaymentIndex'
   ])
        ->name('payment.index');
   Route::get('edit-account', [
    UserPanelController::class,
    'frontPanelUserProfileEdit'
   ])
        ->name('profile.edit');
  });
 });
});
//telegram
Route::group(['as' => ''], function () {
 Route::post('5000545191:AAEQRciGRoWXjw42zwHyqJMUWaQB53WFezw', [
  TelegramController::class,
  'index'
 ]);
 Route::get('/setwebhook', function () {
  return $response = Telegram::setWebhook(['url' => 'https://admin.razzar.ir/5000545191:AAEQRciGRoWXjw42zwHyqJMUWaQB53WFezw']);
 });
 Route::get('/deletewebhook', function () {
  $t = new Api('5000545191:AAEQRciGRoWXjw42zwHyqJMUWaQB53WFezw');
  return $t->deleteWebhook();
 });
 Route::get('/getwebhook', function () {
  return $response = Telegram::getWebhookInfo();
 });
 Route::get('/getUpdates', function () {
  $t = new Api('5000545191:AAEQRciGRoWXjw42zwHyqJMUWaQB53WFezw');
  return $t->getUpdates(['offset' => 423501055]);
 });
 Route::get('/t', function () {
  $r = new App\Http\Controllers\TelegramController();
  $r->adsList();
 });
});
Route::get('/test', function () {
// return
 $content = \Corcel\Model\Post::find(1354)->content;
// /$content = addslashes($content);
// $content = addcslashes($content,'"');
// $content = Str::replace('"', "\"", $content);
// return
// $content = stripslashes($content);
// $content = Str::replace('"', "'", $content);
// return $content;
// $content = htmlspecialchars($content,ENT_QUOTES, 'UTF-8');
// $content = html_entity_decode($content);
// $content =(string) html_entity_decode($content);
// $content =html_entity_decode((string)$content);
//  $content =(string) html_entity_decode($content);
// $content =html_entity_decode((string)$content);
// return
// $content = addslashes($content);
// $content = mysql_real_escape_string($content);
// $content = "کمپانی👑 RENOX 👑
//با تیم کاملا حرفه ای در کوتاه ترین زمان و مناسبت ترین قیمت، خانه رویایی خود را بازسازی نمایید . و انواع خدمات ساختمانی را برایتان انجام میدهد.
//
//🧰 انجام کلیه امور ساختمانی و #بازسازی کامل منزل
//و #لندسکیپ
//
//🧰 طراحی و اجرای کامل #بیسمنت
//
//🧰 طراحی و باسازی حمام و دستشویی اشپزخانه
//
//🧰 #نقاشی ساختمان بصورت کاملا حرفه ای
//
//🧰 نصب انواع سرامیک،سنگ،هاردوود و لمینت
//
//🧰 کلیه کارهای نجاری (کارپنتری)
//و نصب کابینت و ونیتی
//
//🧰🛠برآورد رایگان 🛠🧰
//
//Farzad Rahimi
//647 563 7070
//
//<a href="https://kiusk.ca/blog/1399/09/07/%da%86%da%af%d9%88%d9%86%d9%87-%d8%af%d8%b1-%d8%a7%db%8c%d9%86%d8%aa%d8%b1%d9%86%d8%aa-%d8%af%d9%86%d8%a8%d8%a7%d9%84-%d8%ae%d8%a7%d9%86%d9%87-%d8%a8%da%af%d8%b1%d8%af%db%8c%d9%85%d8%9f/">خرید اینترنتی خانه</a>
//
//<a href="http://karyabee.ca/%d8%aa%d9%82%d8%a7%d8%a8%d9%84-%da%a9%d8%a7%d9%86%d8%a7%d8%af%d8%a7-%d9%88-%da%86%db%8c%d9%86-%d8%a8%d9%87-%da%a9%d8%ac%d8%a7-%d8%b1%d8%b3%db%8c%d8%af-%d8%9f/">تقابل کانادا با چین به کجا رسید</a>";
// $content = "کمپانی👑 RENOX 👑
//با تیم کاملا حرفه ای در کوتاه ترین زمان و مناسبت ترین قیمت، خانه رویایی خود را بازسازی نمایید . و انواع خدمات ساختمانی را برایتان انجام میدهد.
//
//🧰 انجام کلیه امور ساختمانی و #بازسازی کامل منزل
//و #لندسکیپ
//
//🧰 طراحی و اجرای کامل #بیسمنت
//
//🧰 طراحی و باسازی حمام و دستشویی اشپزخانه
//
//🧰 #نقاشی ساختمان بصورت کاملا حرفه ای
//
//🧰 نصب انواع سرامیک،سنگ،هاردوود و لمینت
//
//🧰 کلیه کارهای نجاری (کارپنتری)
//و نصب کابینت و ونیتی
//
//🧰🛠برآورد رایگان 🛠🧰
//
//Farzad Rahimi
//647 563 7070
//
//<a href=\"https://kiusk.ca/blog/1399/09/07/%da%86%da%af%d9%88%d9%86%d9%87-%d8%af%d8%b1-%d8%a7%db%8c%d9%86%d8%aa%d8%b1%d9%86%d8%aa-%d8%af%d9%86%d8%a8%d8%a7%d9%84-%d8%ae%d8%a7%d9%86%d9%87-%d8%a8%da%af%d8%b1%d8%af%db%8c%d9%85%d8%9f/\">خرید اینترنتی خانه</a>
//";
// return
// (new Ad([
//         'content' => (string)($content)
////                                  'content' =>htmlspecialchars_decode($content)
//        ]))->save();
 return App\Models\Ad\Ad::create([
                                  'content' => $content
//                                  'content' =>htmlspecialchars_decode($content)
                                 ]);
 return // \App\Models\Tag::find(4);
  \Corcel\Model\Post::
//type('post')
  type('product')
//                  ->
//with([
//      'taxonomies' => function ($q) {
//       $q->where('taxonomy', 'product_tag');
//      }
//     ])
//                  ->
// whereHas('taxonomies', function ($q) {
//  $q->where('taxonomy', 'product_tag');
// })
//                  ->
// whereHas('taxonomies', function ($q) {
//                   $q->where('taxonomy', 'post_tag');
// })
                    ->without('meta', 'thumbnail')
                    ->published()
                    ->limit(10)
                    ->get();
});