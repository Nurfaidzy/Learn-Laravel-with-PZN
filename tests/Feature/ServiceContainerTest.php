<?php

namespace Tests\Feature;

use App\Data\Foo;
use App\Data\Person;
use App\Data\Bar;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
    public function testDepedency()
    {
        $foo1 = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        self::assertEquals('Foo', $foo1->foo());
        self::assertEquals('Foo', $foo2->foo());
        self::assertSame($foo1, $foo2);
    }

    public function testBind()
    {
        $this->app->bind(Person::class, function ($app) {
            return new Person('John', 'Doe');
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals('John', $person1->firstname);
        self::assertEquals('Doe', $person1->lastname);
        self::assertNotSame($person1, $person2);
    }

    public function testSingleton()
    {
        $this->app->singleton(Person::class, function ($app) {
            return new Person('John', 'Doe');
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals('John', $person1->firstname);
        self::assertEquals('Doe', $person1->lastname);
        self::assertSame($person1, $person2);
    }

    public function testInstance()
    {
        $person = new Person('John', 'Doe');
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals('John', $person1->firstname);
        self::assertEquals('Doe', $person1->lastname);
        self::assertSame($person1, $person2);
        // $this->app->instance(Person::class, new Person('John', 'Doe'));

        // $person1 = $this->app->make(Person::class);
        // $person2 = $this->app->make(Person::class);

        // self::assertEquals('John', $person1->firstname);
        // self::assertEquals('Doe', $person1->lastname);
        // self::assertSame($person1, $person2);
    }

    public function testDepedencyInjaction()
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });

        $this->app->singleton(Bar::class, function ($app) {
            return new Bar($app->make(Foo::class));
        });

        $foo = $this->app->make(Foo::class);
        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertEquals('Foo', $foo->foo());
        self::assertEquals('Foo and Bar', $bar1->bar());
        self::assertEquals('Foo and Bar', $bar2->bar());
        self::assertSame($bar1, $bar2);
    }

    public function testInterfaceToClass()
    {
        // $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

        $this->app->singleton(HelloService::class, function ($app) {
            return new HelloServiceIndonesia();
        });

        $helloService = $this->app->make(HelloService::class);

        self::assertEquals('Halo, John', $helloService->hello('John'));
    }
}
