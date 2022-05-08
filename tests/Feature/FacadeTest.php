<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class FacadeTest extends TestCase
{
    public function testConfig()
    {
        $firtsName1 = config('contoh.author.first');
        $firtsName2 = Config::get('contoh.author.first');

        self::assertEquals($firtsName1, $firtsName2);

        var_dump(Config::all());
    }

    public function testConfigDepedency()
    {
        $config = $this->app->make('config');
        $firtsName3 = $config->get('contoh.author.first');


        $firtsName1 = config('contoh.author.first');
        $firtsName2 = Config::get('contoh.author.first');

        self::assertEquals($firtsName1, $firtsName2);
        self::assertEquals($firtsName1, $firtsName3);

        var_dump(Config::all());
    }

    public function testFacadeMock()
    {
        Config::shouldReceive('get')
            ->with('contoh.author.first')
            ->andReturn('Laravel');

        $firstName = Config::get('contoh.author.first');

        self::assertEquals('Laravel', $firstName);
    }
}
