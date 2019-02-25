<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class MetagramServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'metagram';
    }
}

