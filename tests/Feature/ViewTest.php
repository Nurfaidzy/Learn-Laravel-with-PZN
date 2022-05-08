<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/hello')
            ->assertStatus(200)
            ->assertSeeText('Hello programmer zaman now');

        $this->get('/hello-again')
            ->assertStatus(200)
            ->assertSeeText('Hello programmer zaman now');
    }

    public function testViewNested()
    {
        $this->get('/hello-world')
            ->assertStatus(200)
            ->assertSeeText('World programmer zaman now');
    }

    public function testTemplate()
    {
        $this->view('hello', ['name' => 'programmer zaman now'])
            ->assertSeeText('Hello programmer zaman now');

        $this->view('hello.world', ['name' => 'programmer zaman now'])
            ->assertSeeText('World programmer zaman now');
    }
}
