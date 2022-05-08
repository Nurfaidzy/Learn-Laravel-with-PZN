<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionControllerTest extends TestCase
{
    public function testCreateSession()
    {
        $response = $this->get('/session/create')
            ->assertStatus(200)
            ->assertSee('OK')
            ->assertSessionHas('userId')
            ->assertSessionHas('isMember');
    }
    public function testGetSession()
    {
        $this->withSession(
            [
                'userId' => 'Eko',
                'isMember' => true,
            ]
        )
            ->get('/session/get')
            ->assertStatus(200)
            ->assertSee('User Id: Eko, Member: 1');
    }
}
