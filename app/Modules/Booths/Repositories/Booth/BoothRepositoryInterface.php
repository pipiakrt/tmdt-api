<?php namespace Modules\Booths\Repositories\Booth;


interface BoothRepositoryInterface
{

    public function findEmail($email);

    public function findUserName($username);

}
