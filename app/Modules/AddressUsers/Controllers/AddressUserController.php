<?php

namespace Modules\AddressUsers\Controllers;

use App\Http\Controllers\Controller;
use Modules\AddressUsers\Resources\AddressUser as AddressUserResource;
use Modules\AddressUsers\Resources\AddressUsers as AddressUsersResource;
use Modules\AddressUsers\Models\AddressUser;
use Illuminate\Http\Request;

class AddressUserController extends Controller
{
    public function index(Request $request)
    {
        return AddressUsersResource::collection(AddressUser::paginateFilter($request));
    }

    public function addressActive($user_id){
        $addressActive = AddressUser::where('user_id',$user_id)->where('status', true)->first();
        $data = [];
        if($addressActive){
            return new AddressUsersResource(AddressUser::where('user_id',$user_id)->where('status', true)->first());
        }else{
            return $data;
        }

    }

    public function show($id)
    {
        return new AddressUsersResource(AddressUser::findOrFail($id));
    }

    public function update(AddressUser $addressUser, Request $request)
    {
        if ($addressUser) {
            $addressUser->fill($request->all());
            $addressUser->save();
            return $this->sendResponse(new AddressUserResource($addressUser), 'success');
        } else {
            return $this->sendError(false, 'faild');
        }
    }
    public function store(Request $request)
    {
        $status = $request->get('status');
        $user_id = $request->get('user_id');
        if ($status) {
            $address = AddressUser::where('user_id', $user_id)->get();
            foreach ($address as $value) {
                $value['status'] = 0;
                $value->save();
            }
        }
        $addressUser = new AddressUser();
        $addressUser->fill($request->all());
        $addressUser->save();
        if ($status) {
            return $this->sendResponse(new AddressUserResource($addressUser), 'success');
        } else {
            return $this->sendResponse(true, 'success');
        }
    }
    public function default(Request $request)
    {
        $id = $request['id'];
        $user_id  = $request['userId'];
        $list_address = AddressUser::where('user_id', $user_id)->get();

        foreach ($list_address as $value) {
            if ($value['id'] === $id) {
                $value['status'] = 1;
            } else {
                $value['status'] = 0;
            }

            $value->save();
        }

        $address = AddressUser::where('user_id', $user_id)->where('status', 1)->first();
        $data['list_address'] = AddressUsersResource::collection($list_address);
        $data['address'] = new AddressUserResource($address);

        return $this->sendResponse($data, 'success');
    }
    public function permanent(Request $request)
    {
        $id = $request['id'];
        $user_id  = $request['userId'];
        $list_address = AddressUser::where('user_id', $user_id)->get();

        foreach ($list_address as $value) {
            if ($value['id'] === $id) {
                $value['status'] = 1;
            } else {
                $value['status'] = 0;
            }

            $value->save();
        }

        

        return $this->sendResponse(true, 'success');
    }

    public function delete($id)
    {
        $item = AddressUser::findOrFail($id);

        $item->delete();

        return $this->sendResponse(true, 'success');
    }
}
