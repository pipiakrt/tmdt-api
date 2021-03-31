<?php

namespace Modules\Favourite\Controllers;

use App\Http\Controllers\Controller;

use Modules\Favourite\Resources\Favourite as FavouriteResource;

use Illuminate\Http\Request;
use Modules\Favourite\Models\Favourite;

class FavouriteController extends Controller
{
    //
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 20);
        return FavouriteResource::collection(Favourite::paginateFilter($request,$perPage));
    }

}
