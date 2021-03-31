<?php


namespace App\Services\Transports\Facades;

use Illuminate\Support\Facades\Facade;

class Transport extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'transport';
    }
}