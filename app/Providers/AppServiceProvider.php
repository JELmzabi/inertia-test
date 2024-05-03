<?php

namespace App\Providers;

use App\Channels\DatabaseChannel;
use App\Http\Resources\PhotoResource;
use App\Http\Resources\UserResource;
use Illuminate\Notifications\Channels\DatabaseChannel as IlluminateDatabaseChannel;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        UserResource::withoutWrapping();
        PhotoResource::withoutWrapping();

        $this->app->instance(IlluminateDatabaseChannel::class, new DatabaseChannel);
    }
}
