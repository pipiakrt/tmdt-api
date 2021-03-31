<?php namespace Modules\Wards\Repositories\Ward;

use Modules\Wards\Models\Ward;
use App\Repositories\EloquentRepository;

class OrderRepository extends EloquentRepository implements OrderRepositoryInterface
{

    public function getModel()
    {
        return Ward::class;
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
