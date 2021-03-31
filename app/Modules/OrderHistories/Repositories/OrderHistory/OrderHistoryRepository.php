<?php namespace Modules\OrderHistories\Repositories\OrderHistory;

use Modules\OrderHistories\Models\OrderHistory;
use App\Repositories\EloquentRepository;

class OrderHistoryRepository extends EloquentRepository implements OrderHistoryRepositoryInterface
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
