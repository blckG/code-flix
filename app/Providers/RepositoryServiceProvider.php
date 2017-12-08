<?php

namespace CodeFlix\Providers;

use CodeFlix\Contracts\Repositories\UserRepository;
use CodeFlix\Repositories\UserRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
        $this->app->bind(\CodeFlix\Contracts\Repositories\CategoryRepository::class, \CodeFlix\Repositories\CategoryRepositoryEloquent::class);
        $this->app->bind(\CodeFlix\Contracts\Repositories\SerieRepository::class, \CodeFlix\Repositories\SerieRepositoryEloquent::class);
        $this->app->bind(\CodeFlix\Contracts\Repositories\VideoRepository::class, \CodeFlix\Repositories\VideoRepositoryEloquent::class);
        //:end-bindings:
    }
}
