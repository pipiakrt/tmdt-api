<?php namespace Modules\Categories\Repositories\Category;

use Modules\Categories\Models\Categories;
use App\Repositories\EloquentRepository;

class CategoryRepository extends EloquentRepository implements CategoryRepositoryInterface
{

    public function getModel()
    {
        return Categories::class;
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
