<?php namespace Modules\Payments\Repositories\Payment;


interface PaymentRepositoryInterface
{

    public function findEmail($email);

    public function findUserName($username);

}
