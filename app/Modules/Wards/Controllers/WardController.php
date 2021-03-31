<?php

namespace Modules\Wards\Controllers;

use App\Http\Controllers\Controller;
use Modules\Wards\Resources\Wards as WardsResource;
use Modules\Wards\Models\Ward;
use Illuminate\Http\Request;

class WardController extends Controller
{
    //
    public function index(Request $request){
        $district_id = $request->input('district_id');
        return WardsResource::collection(Ward::where('district_id', $district_id)->get());
    }

}
