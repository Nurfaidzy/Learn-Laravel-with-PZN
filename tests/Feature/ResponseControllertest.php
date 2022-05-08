<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllertest extends TestCase
{
    public function testReponse()
    {
        $this->get('/response')
            ->assertSeeText("hello response");
    }
    public function testHeader()
    {
        $this->get('/response/header')
            ->assertSeeText("hello response")
            ->assertSeeText("application/json")
            ->assertSeeText("programmer zaman now")
            ->assertSeeText("30")
            ->assertSeeText("programmer zaman now")
            ->assertSeeText("20");
    }
    public function testResponseView()
    {
        $this->get('/response/type/view')
            ->assertSeeText("hello programmer zaman now");
    }
    public function testResponseJson()
    {
        $this->get('/response/type/json')
            ->assertSeeText("hello programmer zaman now")
            ->assertSeeText("30");
    }
    public function testResponseFile()
    {
        $this->get('/response/type/file')
            ->assertSeeText("Batu");
    }
    public function testResponseDownload()
    {
        $this->get('/response/type/download')
            ->assertSeeText("Batu");
    }
    public function testFile()
    {
        $this->get('/response/type/file')
            ->assertHeader('Content-Type', 'image/png');
    }
    public function testDownload()
    {
        $this->get('/response/type/download')
            ->assertHeader('Batu.png', 'image/png');
    }
}
