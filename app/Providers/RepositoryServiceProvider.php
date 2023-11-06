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
        $this->app->bind(\App\Repositories\Eloquent\UserRepository::class, \App\Repositories\Contract\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\BusinessRepository::class, \App\Repositories\BusinessRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\BusinessDetailRepository::class, \App\Repositories\BusinessDetailRepositoryEloquent::class);
        $this->app->bind(\App\Contract\Repositories\BusinessInformationRepository::class, \App\Eloquent\Repositories\BusinessInformationRepositoryEloquent::class);
        $this->app->bind(\App\Contract\Repositories\OwnerInformationRepository::class, \App\Eloquent\Repositories\OwnerInformationRepositoryEloquent::class);
        $this->app->bind(\App\Contract\Repositories\BusinessInformationDetailRepository::class, \App\Eloquent\Repositories\BusinessInformationDetailRepositoryEloquent::class);
        $this->app->bind(\App\Contract\Repositories\LessorInformationRepository::class, \App\Eloquent\Repositories\LessorInformationRepositoryEloquent::class);
        $this->app->bind(\App\Contract\Repositories\BusinessFilesRepository::class, \App\Eloquent\Repositories\BusinessFilesRepositoryEloquent::class);
        $this->app->bind(\App\Contract\Repositories\PostRepository::class, \App\Eloquent\Repositories\PostRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contract\BusinessFeesRepository::class, \App\Repositories\Eloquent\BusinessFeesRepositoryEloquent::class);
        //:end-bindings:
    }
}
