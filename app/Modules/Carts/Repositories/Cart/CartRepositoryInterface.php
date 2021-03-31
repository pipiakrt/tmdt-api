<?php namespace Modules\Carts\Repositories\Cart;


interface CartRepositoryInterface
{

    public function findEmail($email);

    public function findUserName($username);

}
