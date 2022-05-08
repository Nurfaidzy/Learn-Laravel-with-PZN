<?php

namespace Tests\Feature;

use App\Services\HelloService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class hellocontrollertest extends TestCase
{
    public function testHello()
    {
        $this->get('/controller/Eko')
            ->assertSee('Hello Eko');
    }

    public function testRequest()
    {
        $this->get('/controller/hello/request', [
            'Accept' => 'plain/text'
        ])->assertSee('/controller/hello/request')
            ->assertSee('http://localhost/controller/hello/request')
            ->assertSee('GET')
            ->assertSee('plain/text');
    }
}
