<?php

namespace App\Providers;

use App\Models\Product\Methods\ProductInterface;
use App\Models\Product\Methods\ProductRepository;
use App\Models\Rating\Methods\RatingInterface;
use App\Models\Rating\Methods\RatingRepository;
use App\Models\User\Methods\UserInterface;
use App\Models\User\Methods\UserRepository;
use Illuminate\Support\ServiceProvider;

class DipendencyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //Register your dipendency injection here
        // $this->app->bind(
        //     interface
        //     repository
        // );
        $this->app->bind(
            UserInterface::class,
            UserRepository::class
        );
        $this->app->bind(
            ProductInterface::class,
            ProductRepository::class
        );
        $this->app->bind(
            RatingInterface::class,
            RatingRepository::class
        );
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
