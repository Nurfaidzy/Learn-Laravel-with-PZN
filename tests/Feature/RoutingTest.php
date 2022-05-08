<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{

    public function testGet()
    {
        $this->get('/pzn')
            ->assertStatus(200)
            ->assertSee('Hello programmer Zaman Now');
    }
    public function testRedierect()
    {
        $this->get('/youtube')
            ->assertRedirect('/pzn');
    }

    public function testFallback()
    {
        $this->get('/tidakada')
            ->assertStatus(200)
            ->assertSee('404 Not Found');
    }

    public function testRouteParameter()
    {
        $this->get('/products/1')
            ->assertSeeText('Product 1');

        $this->get('/products/1/items/2')
            ->assertSeeText('Product 1, Item 2');

        $this->get('/products/1/items/2')
            ->assertSeeText('Product 1, Item 2');

        $this->get('/products/1/items/x')
            ->assertSeeText('Product 1, Item x');
    }

    public function testRouteParameterWithRegex()
    {
        $this->get('/categories/1')
            ->assertSeeText('Category 1');

        $this->get('/categories/x')
            ->assertSeeText('404 Not Found');
    }

    public function testRouteParameterWithOptional()
    {
        $this->get('/user/eko')
            ->assertSeeText('User eko');

        $this->get('/user/')
            ->assertSeeText('User 404');
    }

    public function testRouteParameterWithConflict()
    {
        $this->get('/conflict/budi')
            ->assertSeeText('Conflict budi');

        $this->get('/conflict/eko')
            ->assertSeeText('Conflict eko kurniawan');
    }

    public function testNamedRoute()
    {
        $this->get('/produk/1')
            ->assertSeeText('link http://localhost/products/1');

        $this->get('/produk-redirect/1')
            ->assertSeeText('/products/1');
    }
}
