<?php

namespace Modules\Conditions\Controllers;

use App\Http\Controllers\Controller;
use Modules\Conditions\Resources\Conditions as ConditionsResource;
use Modules\Conditions\Models\Condition;
use Illuminate\Http\Request;

class ConditionController extends Controller
{
    //
    public function index(Request $request){
        return ConditionsResource::collection(Condition::get());
    }

}
