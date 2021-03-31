<?php

namespace Modules\Carts\Controllers;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Modules\Products\Models\Product;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $id = $request->input('id');
        $quantity = $request->input('quantity');

        $product = Product::findOrFail($id);

        Cart::add(['id' => $id, 'name' => $product['name'], 'qty' => $quantity, 'price' => $product['discount'], 'booths' => $product['booths_id']]);
        Session::put('abc', true);
        return Cart::instance('shopping')->content();
    }

    public function index(Request $request)
    {
        return Session::get('abc');
    }
}
