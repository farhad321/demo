<?php

use App\Http\Controllers\Blog\BlogController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SeedController;
use App\Http\Controllers\SeedPostController;
use App\Http\Controllers\TelegramController;
use App\Models\Ad\Ad;
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
//telegram
Route::post('5000545191:AAEQRciGRoWXjw42zwHyqJMUWaQB53WFezw', [
 TelegramController::class,
 'index'
]);
//Route::post('5000545191:AAEQRciGRoWXjw42zwHyqJMUWaQB53WFezw', function () {
//// $update = Telegram::commandsHandler(true);
// $telegram = new Api('5000545191:AAEQRciGRoWXjw42zwHyqJMUWaQB53WFezw');
// $update = $telegram->getWebhookUpdates();
// $message = $update->getMessage();
// $user = $message->getFrom();
// $response = $telegram->sendMessage([
//                                     'chat_id' => $message->getChat()
//                                                          ->getId(),
//                                     'text' => $user->getFirstName()
//                                      . $user->getLastName()
//                                      . PHP_EOL
//                                      . 'پیام شما هست:'
//                                      . $message->getText()
//                                    ]);
//});
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
//Route::get('/getUpdates/{aa?}', function ($aa) {
// $t = new Api('5000545191:AAEQRciGRoWXjw42zwHyqJMUWaQB53WFezw');
// return
//  $t->getUpdates($aa?['offset'=>$aa]:[]);
//});
//
//
Route::get('/t', function () {
 $r = new App\Http\Controllers\TelegramController();
 $r->adsList();
//
// return $model = \Corcel\Model\Post::published()
//                                   ->with('attachment')
//                                   ->whereHas('attachment')
//                                   ->limit(2)
//                                   ->get()//                            ->first()
//  ;
// $meta = $model->attachment[0]->getMeta('_wp_attached_file');
//// return
//// storage_path('app/public/uploads');
////  $meta;
//// return $model;
////// return
////// $model->slug;
// $ad = Post::whereSlug($model->slug)
//           ->first();
// $ad->addMedia(storage_path('app/public/uploads/') . $meta)
//////  ->addMediaFromUrl($model->image)
//    ->toMediaCollection('spatial');
////
//// ->disk;
// return $ad->load('media');
});