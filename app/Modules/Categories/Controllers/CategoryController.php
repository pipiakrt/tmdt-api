<?php

namespace Modules\Categories\Controllers;

use App\Http\Controllers\Controller;
use Modules\Categories\Models\Category;
use Modules\Categories\Resources\Categories as CategoriesResource;
use Modules\Categories\Resources\Category as CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request){
        return CategoriesResource::collection(Category::where('status', true)->paginateFilter($request));
    }

    public function filter(Request $request)
    {
        return CategoriesResource::collection(Category::where('status', true)->paginateFilter($request));
    }
    public function show($id)
    {
        return new CategoryResource(Category::findOrFail($id));
    }
}
