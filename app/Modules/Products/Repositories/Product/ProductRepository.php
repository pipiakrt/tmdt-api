<?php namespace Modules\Products\Repositories\User;

use Modules\Products\Models\Product;
use App\Repositories\EloquentRepository;

class ProductRepository extends EloquentRepository implements ProductRepositoryInterface
{

    public function getModel()
    {
        return Product::class;
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
