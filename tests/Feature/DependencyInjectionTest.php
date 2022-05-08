<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DependencyInjectionTest extends TestCase
{
    public function testDepedencyInjection()
    {
        $bar = new Bar(new Foo);
        $this->assertEquals('Foo and Bar', $bar->bar());

        // $foo = new Foo();
        // $bar = new Bar($foo);

        // self::assertEquals('Foo and Bar', $bar->bar());
    }
}
