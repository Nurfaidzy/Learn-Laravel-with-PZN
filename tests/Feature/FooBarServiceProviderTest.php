<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FooBarServiceProviderTest extends TestCase implements DeferrableProvider
{
    public function testServiceProvider()
    {
        $foo1 = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        self::assertSame($foo1, $foo2);

        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($bar1, $bar2);
    }

    public function testPropertySingletons()
    {
        $helloService1 = $this->app->make(HelloService::class);
        $helloService2 = $this->app->make(HelloService::class);

        self::assertSame($helloService1, $helloService2);

        self::assertEquals('Halo, John Doe', $helloService1->hello('John Doe'));
    }

    public function boot()
    {
    }
}
