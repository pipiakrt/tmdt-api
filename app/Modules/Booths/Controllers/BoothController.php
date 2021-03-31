<?php

namespace Modules\Booths\Controllers;

use App\Http\Controllers\Controller;
use Modules\Account\Models\User;
use Modules\Booths\Models\Booth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Modules\Booths\Requests\Booth\RegisterRequest;
use Modules\Booths\Resources\Booth as ResourcesBooth;
use Modules\Booths\Resources\Booths;

class BoothController extends Controller
{
    public function store(RegisterRequest $request)
    {
        $data = $request->only('name', 'phone', 'email', 'address', 'province_id', 'district_id', 'ward_id', 'description');
        $user_id = $request->user_id;
        $booth = new Booth();
        // if ($request->file) {
        //     //Ảnh avatar
        //     $file = $request->file('file');
        //     $imageName = time() . '.' . $file->getClientOriginalExtension();
        //     $path_avatar = public_path('/images/booths/' . $user_id . '/avatar');

        //     if (!$path_avatar) {
        //         File::makeDirectory($path_avatar, $mode = 0777, true, true);
        //         $file->move($path_avatar, $imageName);
        //         $data['avatar'] = '/images/booths/' . $user_id . '/avatar/' . $imageName;
        //     } else {
        //         $file->move($path_avatar, $imageName);
        //         $data['avatar'] = '/images/booths/' . $user_id . '/avatar/' . $imageName;
        //     }

        //     //Ảnh bìa
        //     $file = $request->file('file_cover');
        //     $imageNameCover = time() . '.' . $file->getClientOriginalExtension();
        //     $path_avatar = public_path('/images/booths/' . $user_id . '/cover');

        //     if (!$path_avatar) {
        //         File::makeDirectory($path_avatar, $mode = 0777, true, true);
        //         $file->move($path_avatar, $imageNameCover);
        //         $data['cover'] = '/images/booths/' . $user_id . '/cover/' . $imageNameCover;
        //     } else {
        //         $file->move($path_avatar, $imageNameCover);
        //         $data['cover'] = '/images/booths/' . $user_id . '/cover/' . $imageNameCover;
        //     }
        // }
        $data['user_id'] = $user_id;
        $data['status'] = 1;

        $booth->fill($data);
        $booth->save();

        $use = User::findOrFail($user_id);
        $use['booth_id'] = $booth['id'];

        $use->save();

        return $this->sendResponse(true, 'success');
    }

    public function index(Request $request)
    {
        $user_id = $request->input('user');
        return new ResourcesBooth(Booth::where('user_id', $user_id)->first());
    }

    public function show($id)
    {
        return new ResourcesBooth(Booth::findOrFail($id));
    }

    public function changeImage(Request $request)
    {
        $id = $request->id;
        $booth = Booth::findOrFail($id);
        $flag = 'avatar';
        $type = $request->type;
        if ($type === 'cover') 
        {
            $flag = 'cover';
        }
        if ($type === 'cover') 
        {
            Storage::delete($booth->cover);
        }
        else 
        {
            Storage::delete($booth->avatar);
        }

        if ($request->file) {
            //Ảnh avatar
            $file = $request->file('file');
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $path_avatar = '/images/booths/' . $booth['user_id'] . '/'.$flag.'/'.$imageName;
            $booth[$flag] = $path_avatar;
            Storage::put($path_avatar, File::get($request->file));
            
            $booth->save();
            
            return new ResourcesBooth($booth);
        }
        return $this->sendResponse(false, 'Faild');
    }

    public function update($id, Request $request)
    {
        $booth = Booth::find($id);
        $booth->name = $request->name;
        $booth->description = $request->description;
        $booth->phone = $request->phone;
        $booth->address = $request->address;
        $booth->province_id = $request->province_id;
        $booth->district_id = $request->district_id;
        $booth->ward_id = $request->ward_id;
        $booth->save();
        return $this->sendResponse(true, 'success');
    }
}
