<?php namespace Modules\Products\Repositories\User;


interface ProductRepositoryInterface
{

    public function findEmail($email);

    public function findUserName($username);

}
