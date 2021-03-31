<?php
namespace Modules\Product\Repositories\AddressUser;


interface AddressUsersRepositoryInterface
{

    public function findEmail($email);

    public function findUserName($username);

}
