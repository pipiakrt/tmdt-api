<?php namespace Modules\AttributeDetails\Repositories\AttributeDetail;


interface AttributeDetailRepositoryInterface
{

    public function findEmail($email);

    public function findUserName($username);

}
