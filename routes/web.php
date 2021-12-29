<?php

use App\Models\Ad\Ad;
use App\Models\User;
use Corcel\Model\Post;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * @param $post
 * @return Closure
 */
Route::get('seed/ads', [
 \App\Http\Controllers\SeedController::class,
 'ads',
]);
Route::get('seed/tags', [
 \App\Http\Controllers\SeedController::class,
 'tags',
]);
Route::get('seed/categories', [
 \App\Http\Controllers\SeedController::class,
 'categories',
]);
Route::get('seed/posts', [
 \App\Http\Controllers\SeedPostController::class,
 'posts',
]);
Route::get('seed/posts/tags', [
 \App\Http\Controllers\SeedPostController::class,
 'tags',
]);
Route::get('seed/posts/categories', [
 \App\Http\Controllers\SeedPostController::class,
 'categories',
]);