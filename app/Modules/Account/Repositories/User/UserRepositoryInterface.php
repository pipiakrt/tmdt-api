<?php namespace Modules\Account\Repositories\User;


interface UserRepositoryInterface
{

    public function findEmail($email);

    public function findUserName($username);

}
