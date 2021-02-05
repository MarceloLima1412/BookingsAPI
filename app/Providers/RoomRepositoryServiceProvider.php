<?php

namespace App\Providers;

use App\Repositories\RoomRepository\RoomRepository;
use App\Repositories\RoomRepository\RoomRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RoomRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RoomRepositoryInterface::class,RoomRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
