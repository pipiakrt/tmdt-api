<?php namespace Modules\Payments\Repositories\Payment;

use Modules\Payments\Models\OrderHistory;
use App\Repositories\EloquentRepository;

class PaymentRepository extends EloquentRepository implements PaymentRepositoryInterface
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
