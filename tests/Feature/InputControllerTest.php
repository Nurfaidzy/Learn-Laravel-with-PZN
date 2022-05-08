<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testInput()
    {
        $this->get('/input/hello?name=programmer zaman now')
            ->assertSee('programmer zaman now');

        $this->post('/input/hello', ['name' => 'programmer zaman now'])
            ->assertSee('programmer zaman now');
    }

    public function testInputNested()
    {
        $this->post('/input/hello/first', [
            'name' => [
                "first" => "Eko",
                "last" => "Kurniawan"
            ]
        ])->assertSee('Hello Eko');
    }

    public function testInputAll()
    {
        $this->post('/input/hello/input', [
            'name' => [
                "first" => "Eko",
                "last" => "Kurniawan"
            ]
        ])->assertSee('name')->assertSee('first')->assertSee('last')
            ->assertSee('Eko')->assertSee('Kurniawan');
    }
    public function testInputArray()
    {
        $this->post('/input/hello/array', [
            'products' => [
                [
                    'name' => 'Eko Kurniawan',
                    'price' => 'Rp. 1.000.000'
                ],
                [
                    'name' => 'Eko Kurniawan',
                    'price' => 'Rp. 1.000.000'
                ]
            ]
        ])->assertSee('Eko Kurniawan')->assertSee('Eko Kurniawan');
    }
    public function testInputType()
    {
        $this->post('/input/type', [
            'name' => 'budi',
            'married' => 'true',
            'birth_date' => '2020-01-01'
        ])->assertSee('budi')->assertSee('true')->assertSee('2020-01-01');
    }
    public function testInputFilterOnly()
    {
        $this->post('/input/filter/only', [
            'name' => [
                "first" => "Eko",
                "last" => "Kurniawan"
            ]
        ])->assertSee('Eko')->assertSee('Kurniawan');
    }
    public function testInputFilterExcept()
    {
        $this->post('/input/filter/except', [
            "username" => "Eko",
            "password" => "Kurniawan",
            "admin" => "true"
        ])->assertSee('Eko')->assertSee('Kurniawan');
    }
    public function testInputFilterMerge()
    {
        $this->post('/input/filter/merge', [
            "username" => "Eko",
            "password" => "Kurniawan",
            "admin" => "true"
        ])->assertSee('Eko')->assertSee('Kurniawan')->assertSee('false');
    }
}
