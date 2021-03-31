<?php namespace Modules\Wards\Repositories\Ward;


interface WardRepositoryInterface
{

    public function findEmail($email);

    public function findUserName($username);

}
