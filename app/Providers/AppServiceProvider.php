<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    //

    Blade::if('admin', function () {
      if (! Auth()->check()) return redirect()->route('logout');
      if (Auth()->user()->is_admin) return true;
      return false;
    });

    Blade::if('staff', function () {
      if (! Auth()->check()) return redirect()->route('logout');
      if (Auth()->user()->is_admin) return false;
      return true;
    });
  }
}
