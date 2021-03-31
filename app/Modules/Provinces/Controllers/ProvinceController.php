<?php

namespace Modules\Provinces\Controllers;

use App\Http\Controllers\Controller;
use Modules\Provinces\Models\Province;
use Modules\Provinces\Resources\Provinces as ProvincesResource;

use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    //
    public function index(Request $request){
        return ProvincesResource::collection(Province::get());
    }

}
