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
Route::group(['as' => 'front.'], function () {
 Route::get('', [
  HomeController::class,
  'frontHome'
 ])
      ->name('home');
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
  Route::get('newad', [
   AdsController::class,
   'frontAdCreate'
  ])
       ->name('create');
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
   Route::get('product-tag/{slug?}', [
    AdsController::class,
    'frontAdTagIndex'
   ])
        ->name('index');
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
   Route::get('{page?}/اخبار', [
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
   Route::get('tags/{slug?}', [
    BlogController::class,
    'frontBlogTagIndex'
   ])
        ->name('index');
  });
 });
 Route::group([
               'as' => 'panel.user.',
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
 return \Corcel\Model\Post::with('attachment', 'thumbnail')
                          ->whereHas('attachment')
                          ->whereDoesntHave('thumbnail')
                          ->first()?->thumbnail == null;
 request()->request->add([
                          'page' => 1
                         ]);
 $slug = 'تدریس-خصوصی';
 $category = Category::whereSlug(urlencode($slug))
                     ->first();
//  return
 $ads = Ad::
 whereHas('categories', function (Builder $q) use ($slug) {
  return $q->whereSlug(urlencode($slug));
 })
          ->with('categories')
          ->latest()
          ->paginate(16);
// $urls = $this->getUrls($ads);
 $linkCollection = $ads->linkCollection();
 $urls = $linkCollection->map(function ($item, $key) {
  $item['disabled'] = false;
  $stringable = Str::of($item['label']);
  if ($stringable->contains([
                             'Next',
                             'Previous'
                            ]) && request()->fullUrl() == $item['url']) {
   $item['disabled'] = true;
  }
//  if ($stringable->contains('Previous')) {
//   $item['label'] = '&laquo;';
//  }
//  elseif ($stringable->contains('Next')) {
//   $item['label'] = '&raquo;';
//  }
  $item['url'] = Str::of($item['url'])
                    ->replaceMatches("/\/page\/\d*/", '',)
                    ->replaceMatches("/\?/", '/',)
                    ->replaceMatches("/\=/", '/',);
  return $item;
 });
 return $urls;
////  return view('ad.category', compact('urls', 'ads', 'category'));
// return view('front.pages.ads.category.index',compact('urls', 'ads', 'category'));
//
//
 return \App\Models\Ad\Category::with('attrs')
                               ->find(66)

//  ->attrs
//                       ->toArray()
  ;
});