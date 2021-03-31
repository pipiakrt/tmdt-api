<?php


namespace App\Services\Transports\Drivers;


use Carbon\Carbon;
use App\Services\Transports\Contracts\Transport;
use Illuminate\Support\Facades\Session;

abstract class Driver implements Transport
{
    public $data;
    public $order;

    public function order($order)
    {
        $this->order = $order;
        return $this;
    }

    abstract public function sendOrder();

    abstract public function shipFee();

    abstract public function statusOrder();

    abstract public function cancelOrder();

    abstract public function printOrder();

    abstract public function listAddressPickup();
}
