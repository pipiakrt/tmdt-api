<?php namespace Modules\Provinces\Repositories\Province;


interface ProvinceRepositoryInterface
{

    public function findEmail($email);

    public function findUserName($username);

}
