<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register for admin core services.
   */
  public function register(): void
  {
    $this->app->bind(
      'App\Interfaces\Admin\DashboardInterface',
      'App\Repositories\Admin\DashboardRepository'
    );
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void {}
}
