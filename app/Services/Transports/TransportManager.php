<?php
namespace App\Services\Transports;

use App\Services\Transports\Drivers\GhtkDriver;
use Illuminate\Support\Manager;

class TransportManager extends Manager
{
    /**
     * Get a driver instance.
     *
     * @param  string|null  $name
     * @return mixed
     */
    public function channel($name = null)
    {
        return $this->driver($name);
    }

    public function createGhtkDriver()
    {
        return new GhtkDriver();
    }

    public function createGhnDriver()
    {
        return new GhtkDriver();
    }

    public function getDefaultDriver()
    {
        return 'Ghtk';
    }

}
