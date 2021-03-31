<?php namespace Modules\Conditions\Repositories\Condition;


interface ConditionRepositoryInterface
{

    public function findEmail($email);

    public function findUserName($username);

}
