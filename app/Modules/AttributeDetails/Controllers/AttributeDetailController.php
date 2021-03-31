<?php

namespace Modules\AttributeDetails\Controllers;

use App\Http\Controllers\Controller;
use Modules\AttributeDetails\Resources\AttributeDetails as AttributeDetailsResource;
use Illuminate\Http\Request;
use Modules\AttributeDetails\Models\AttributeDetail;
use Modules\AttributeDetails\Resources\AttributeDetail as AttributeDetailResource;

class AttributeDetailController extends Controller
{
    public function index(Request $request)
    {
        return AttributeDetailsResource::collection(AttributeDetail::paginateFilter($request));
    }
    public function show($id)
    {
        return new AttributeDetailResource(AttributeDetail::findOrFail($id));
    }
}
