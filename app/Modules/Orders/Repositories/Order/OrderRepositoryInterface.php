<?php namespace Modules\Wards\Repositories\Order;


interface OrderRepositoryInterface
{

    public function findEmail($email);

    public function findUserName($username);

}
