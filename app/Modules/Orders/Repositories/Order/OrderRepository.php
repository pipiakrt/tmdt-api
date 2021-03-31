<?php namespace Modules\Wards\Repositories\Order;

use Modules\Wards\Models\Order;
use App\Repositories\EloquentRepository;

class OrderRepository extends EloquentRepository implements OrderRepositoryInterface
{

    public function getModel()
    {
        return Order::class;
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
