<?php namespace Modules\Categories\Repositories\AddressUser;

use Modules\AddressUsers\Models\AddressUser;
use App\Repositories\EloquentRepository;

class AddressUserRepository extends EloquentRepository implements CategoryRepositoryInterface
{

    public function getModel()
    {
        return AddressUser::class;
    }



}
