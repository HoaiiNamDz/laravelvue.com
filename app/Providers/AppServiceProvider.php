<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Providers\RepositoryServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    protected $serviceBinding = [
        'App\Services\Interfaces\User\UserGroupServiceInterface' => 'App\Services\User\UserGroupService',
        'App\Services\Interfaces\User\UserServiceInterface' => 'App\Services\User\UserService',
    ];
    public function register(): void
    {
        // Sanctum::getAccessTokenFromRequestUsing(function($request) {
        //     return $request->cookie('backend_token');
        // });
        foreach ($this->serviceBinding as $key => $val) {
            $this->app->bind($key, $val);
        }
        $this->app->register(RepositoryServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
