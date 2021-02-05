<?php

namespace App\Providers;

use App\Services\RoomServices\RoomService;
use App\Services\RoomServices\RoomServiceInterface;
use Illuminate\Support\ServiceProvider;

class RoomServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RoomServiceInterface::class, RoomService::class);
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
