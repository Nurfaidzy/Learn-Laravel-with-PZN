<?php

namespace App\Data;

class Person
{
    public function __construct(
        public string $firstname,
        public string $lastname
    ) {
    }
}
