<?php

namespace App\AuthManager\Facades;

use Illuminate\Support\Facades\Facade;

class AuthManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'AuthManager';
    }
}