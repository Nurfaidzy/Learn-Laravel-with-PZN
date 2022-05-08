<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Env;
use Tests\TestCase;

class EnvironmentTest extends TestCase
{
    public function testGetEnv()
    {
        $youtube = env('Youtube');
        self::assertEquals('Programmer Zaman Now', $youtube);
    }

    public function testDefaultEnv()
    {
        // $author = env('Author', 'Jaman Now');
        $author = Env::get('Author', 'Zaman Now');
        self::assertEquals('Zaman Now', $author);
    }
}
