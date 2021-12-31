<?php

use App\Http\Controllers\Blog\BlogController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SeedController;
use App\Http\Controllers\SeedPostController;
use App\Models\Ad\Ad;
use App\Models\Blog\Post;
use App\Models\User;

//use Corcel\Model\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

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