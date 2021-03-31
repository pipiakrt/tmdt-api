<?php namespace Modules\Provinces\Repositories\Province;

use Modules\Provinces\Models\OrderHistory;
use App\Repositories\EloquentRepository;

class ProvinceRepository extends EloquentRepository implements ProvinceRepositoryInterface
{

    public function getModel()
    {
        return OrderHistory::class;
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
