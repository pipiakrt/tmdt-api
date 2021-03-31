<?php namespace Modules\Districts\Repositories\District;


interface DistrictRepositoryInterface
{

    public function findEmail($email);

    public function findUserName($username);

}
