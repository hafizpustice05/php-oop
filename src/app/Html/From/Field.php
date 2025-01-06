<?php

namespace App\Html\From;

abstract class Field implements Renderable
{

    public function __construct(protected string $name)
    {

    }
}
