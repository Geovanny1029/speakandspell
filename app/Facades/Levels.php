<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Levels extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'levels';
    }
}