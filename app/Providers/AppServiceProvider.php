<?php

namespace App\Providers;

use App\Events\RegisteredEvent;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\UserRepositiryInterface;
use App\Listeners\SendMailRegisteredListener;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(UserRepositiryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Event::listen(
            RegisteredEvent::class,
            SendMailRegisteredListener::class,
        );
    }
}
