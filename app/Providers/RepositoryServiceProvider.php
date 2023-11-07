<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\Contract\UserRepository::class, \App\Repositories\Eloquent\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contract\BusinessRepository::class, \App\Repositories\Eloquent\BusinessRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\BusinessDetailRepository::class, \App\Repositories\BusinessDetailRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contract\BusinessFeesRepository::class, \App\Repositories\Eloquent\BusinessFeesRepositoryEloquent::class);
        //:end-bindings:
    }
}
