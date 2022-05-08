<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContohMiddlewareTest extends TestCase
{
    public function testMiddlewareInvalid()
    {
        $this->get('/middleware/api')
            ->assertStatus(401)
            ->assertSeeText("Access denied.");
    }
    public function testMiddlewarevalid()
    {
        $this->withHeader('X-API-KEY', 'PZN')
            ->get('/middleware/api')
            ->assertStatus(200)
            ->assertSeeText("OK");
    }


    public function testMiddlewareInvalidGroup()
    {
        $this->get('/middleware/group')
            ->assertStatus(401)
            ->assertSeeText("Access denied.");
    }
    public function testMiddlewarevalidGroup()
    {
        $this->withHeader('X-API-KEY', 'PZN')
            ->get('/middleware/api')
            ->assertStatus(200)
            ->assertSeeText("OK");
    }
}
