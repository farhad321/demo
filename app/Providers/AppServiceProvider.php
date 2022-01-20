<?php

namespace App\Providers;

use App\Models\Ad\Ad;
use App\Models\Blog\Post;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
 /**
  * Register any application services.
  * @return void
  */
 public function register()
 {
  $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
 }

 /**
  * Bootstrap any application services.
  * @return void
  */
 public function boot()
 {
  Filament::registerNavigationGroups([
                                      'Ads',
                                      'Blog',
                                     ]);
  Relation::enforceMorphMap([
                             'post' => Post::class,
                             'ad' => Ad::class,
                             'user' => User::class,
                            ]);
 }
}
