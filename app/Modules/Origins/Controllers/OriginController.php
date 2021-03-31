<?php

namespace Modules\Origins\Controllers;

use App\Http\Controllers\Controller;
use Modules\Origins\Resources\Origins as OriginsResource;
use Modules\Origins\Models\Origin;
use Illuminate\Http\Request;

class OriginController extends Controller
{
    public function index(Request $request){
        return OriginsResource::collection(Origin::paginateFilter($request));
    }

}
