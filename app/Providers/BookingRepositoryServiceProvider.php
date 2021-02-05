<?php

namespace App\Providers;

use App\Repositories\BookingRepository\BookingRepository;
use App\Repositories\BookingRepository\BookingRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class BookingRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BookingRepositoryInterface::class,BookingRepository::class);
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
