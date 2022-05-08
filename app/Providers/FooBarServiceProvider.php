<?php

namespace App\Providers;

use App\Data\Foo;
use App\Data\Bar;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Support\ServiceProvider;

class FooBarServiceProvider extends ServiceProvider
{
    public array $singletons = [
        HelloService::class => HelloServiceIndonesia::class,
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // echo "FooBarServiceProvider: register()\n";
        //
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });
        $this->app->singleton(Bar::class, function ($app) {
            return new Bar($app->make(Foo::class));
        });
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

    public function provides(): array
    {
        return [
            HelloService::class => HelloServiceIndonesia::class,
        ];
    }
}
