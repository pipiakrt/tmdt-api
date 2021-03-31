<?php

namespace Modules\Payments\Controllers;

use App\Http\Controllers\Controller;
use Modules\Payments\Models\Payment;
use Modules\Payments\Resources\Payments as PaymentsResource;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    public function index(Request $request){

        return PaymentsResource::collection(Payment::paginateFilter($request));
    }

}
