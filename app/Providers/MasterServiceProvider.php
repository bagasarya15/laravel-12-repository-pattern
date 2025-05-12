<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MasterServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    $this->app->bind(
      'App\Interfaces\Master\PetugasInterface',
      'App\Repositories\Master\PetugasRepository'
    );

    $this->app->bind(
      'App\Interfaces\Master\PengunjungInterface',
      'App\Repositories\Master\PengunjungRepository'
    );
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void {}
}
