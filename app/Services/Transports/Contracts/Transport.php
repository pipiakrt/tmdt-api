<?php
namespace App\Services\Transports\Contracts;

interface Transport
{
    /**
     * Send the given message to the given recipient.
     *
     * @return mixed
     */
    public function sendOrder();
    public function shipFee();
    public function statusOrder();
    public function cancelOrder();
    public function printOrder();
    public function listAddressPickup();
}
