<?php

class SomeClass{
    public string $foo = 'whatever';

    function goo(): void{
        // Do nothing
    }
}

$s = new SomeClass();
echo $s->foo;
$s->goo();
