<?php

namespace App\Providers;

use Filament\Facades\Filament;
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
 }
}
