<?php namespace Modules\Origins\Repositories\Origin;


interface OriginRepositoryInterface
{

    public function findEmail($email);

    public function findUserName($username);

}
