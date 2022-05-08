<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConnfigurationTest extends TestCase
{

    public function testConfig()
    {
        $first = config('contoh.author.first');
        $last = config('contoh.author.last');
        $email = config('contoh.email');
        $address = config('contoh.address');

        self::assertEquals('Laravel', $first);
        self::assertEquals('Laravel2', $last);
        self::assertEquals('nurfaidzy@gmail.com', $email);
        self::assertEquals('Jl. Kebon Kacang No.1', $address);
    }
}
