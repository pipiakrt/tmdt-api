<?php namespace Modules\Districts\Repositories\District;

use Modules\Districts\Models\District;
use App\Repositories\EloquentRepository;

class DistrictRepository extends EloquentRepository implements DistrictRepositoryInterface
{

    public function getModel()
    {
        return District::class;
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
