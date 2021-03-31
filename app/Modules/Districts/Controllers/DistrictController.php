<?php

namespace Modules\Districts\Controllers;

use App\Http\Controllers\Controller;
use Modules\Districts\Resources\Districts as DistrictsResource;
use Modules\Districts\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    //
    public function index(Request $request){
        $province_id = $request->input('province_id');
        return DistrictsResource::collection(District::where('province_id', $province_id)->get());
    }

}
