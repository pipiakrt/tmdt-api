<?php namespace Modules\Favourite\Repositories\Favourite;


interface FavouriteRepositoryInterface
{

    public function findEmail($email);

    public function findUserName($username);

}
