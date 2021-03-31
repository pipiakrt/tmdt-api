<?php namespace Modules\Carts\Repositories\Cart;

use App\Repositories\EloquentRepository;

class CartRepository extends EloquentRepository implements CartRepositoryInterface
{

    public function getModel()
    {
        return Cart::class;
    }
}
