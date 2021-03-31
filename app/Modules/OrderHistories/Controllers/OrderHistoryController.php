<?php

namespace Modules\OrderHistories\Controllers;

use App\Http\Controllers\Controller;
use Modules\OrderHistories\Resources\OrderHistories as OrderHistoriesResource;
use Modules\OrderHistories\Models\OrderHistory;
use Illuminate\Http\Request;

class OrderHistoryController extends Controller
{
    //
    public function index(Request $request)
    {
        return OrderHistoriesResource::collection(OrderHistory::paginateFilter($request));
    }

    

    

}
