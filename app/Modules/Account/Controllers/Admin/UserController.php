<?php

namespace Modules\Account\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource as UsersResource;
use Modules\Account\Resources\User as UserResource;
use Modules\Account\Models\User;
use Illuminate\Http\Request;
use Modules\Account\Requests\User\StoreRequest;
use Modules\Account\Requests\User\UpdateRequest;

class UserController extends Controller
{
    public $permissions = [
        'list user' => 'index',
        'view user' => 'show',
        'create user' => 'store',
        'edit user' => 'update',
        'delete user' => 'destroy',
    ];
    //
    public function index(Request $request){
        return UsersResource::collection(User::paginateFilter($request));
    }

    public function show(User $user){
        //$user->assignRole('admin');
        return new UserResource($user);
    }

    public function store(StoreRequest $request){
        $user = User::create($request->all());
        return new UserResource($user);
    }

    public function update(User $user, UpdateRequest $request){
        $user->update($request->all());
        return new UserResource($user);
    }

    public function destroy(User $user) {
        try {
            //$user->delete();
        } catch (\Exception $e) {
        }
    }
}
