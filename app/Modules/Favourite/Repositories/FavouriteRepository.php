<?php namespace Modules\Favourite\Repositories\Favourite;

use Modules\Favourite\Models\Favourite;
use App\Repositories\EloquentRepository;

class FavouriteRepository extends EloquentRepository implements FavouriteRepositoryInterface
{

    public function getModel()
    {
        return Favourite::class;
    }

    public function findEmail($email)
    {
        return $this->_model->where('email', $email)->first();
    }

    public function findUserName($username)
    {
        return $this->_model->where('username', $username)->first();
    }

}
