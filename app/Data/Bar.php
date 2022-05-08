<?php

namespace App\Data;

class Bar
{
    public function bar(): string
    {
        return "Foo and Bar";
    }

    // private Foo $foo;

    // public function __construct(Foo $foo)
    // {
    //     $this->foo = $foo;
    // }

    // function bar(): string
    // {
    //     return $this->foo->foo() . ` and Bar`;
    // }
}
