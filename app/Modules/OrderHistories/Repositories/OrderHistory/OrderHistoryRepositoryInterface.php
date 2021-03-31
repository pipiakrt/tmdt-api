<?php namespace Modules\OrderHistories\Repositories\Province;


interface OrderHistoryRepositoryInterface
{

    public function findEmail($email);

    public function findUserName($username);

}
