<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Laravel\Sanctum\Sanctum;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    protected $repositoryBinding = [
        'App\Repositories\Interfaces\User\UserGroupRepositoryInterface' => 'App\Repositories\User\UserGroupRepository',
        'App\Repositories\Interfaces\User\UserRepositoryInterface' => 'App\Repositories\User\UserRepository',
    ];
    public function register(): void
    {
        // Sanctum::getAccessTokenFromRequestUsing(function($request) {
        //     return $request->cookie('backend_token');
        // });
        foreach ($this->repositoryBinding as $key => $val) {
            $this->app->bind($key, $val);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
