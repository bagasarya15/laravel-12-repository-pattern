<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    $this->app->bind(
      'App\Interfaces\Auth\AuthInterface',
      'App\Repositories\Auth\AuthRepository'
    );

    $this->app->bind(
      'App\Interfaces\Auth\UserInterface',
      'App\Repositories\Auth\UserRepository'
    );

    $this->app->bind(
      'App\Interfaces\Auth\RoleInterface',
      'App\Repositories\Auth\RoleRepository'
    );
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    //
  }
}
