<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class EncryptionTest extends TestCase
{
    public function testEncryption()
    {
        $encryption = Crypt::encryptString('programmer zaman now');
        var_dump($encryption);

        $decryption = Crypt::decryptString($encryption);


        self::assertEquals('programmer zaman now', $decryption);
    }
}
