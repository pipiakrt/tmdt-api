<?php

namespace Modules\Account\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource as ProfileResource;
use Modules\Account\Resources\User as UserResource;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Jobs\resetPassword;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Storage;
use Str;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        return new UserResource($request->user());
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }


    public function changeImage(Request $request)
    {
        $id = $request->id;
        $account = User::findOrFail($id);
        $flag = 'avatar';
        $type = $request->type;
        if ($type === 'cover') {
            $flag = 'cover';
        }
if ($type === 'cover') {
    Storage::delete($account->cover);
} else {
    Storage::delete($account->avatar);
}

        if ($request->file) {
            //Ảnh avatar
            $file = $request->file('file');
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $path_avatar = '/images/account/' . $account['id'] . '/'.$flag.'/'.$imageName;
            $account[$flag] = $path_avatar;

            // if (!$path_avatar) {
            //     File::makeDirectory($path_avatar, $mode = 0777, true, true);
            //     $file->move($path_avatar, $imageName);
            //     $account[$flag] = '/images/account/' . $account['id'] . '/'.$flag.'/'.$imageName;
            // } else {
            //     $file->move($path_avatar, $imageName);
            //     $account[$flag] = '/images/account/' . $account['id'] . '/'.$flag.'/'.$imageName;
            // }
            Storage::put($path_avatar, File::get($request->file));

 
            $account->save();

            return $this->sendResponse($account, 'success');
        }
        
        return $this->sendResponse(false, 'Faild');
    }

    public function update($id, Request $request)
    {
        $account = user::find($id);
        $account->fill($request->all());
        $account->save();
        return $this->sendResponse(true, 'success');
    }

    public function changePassword(Request $request)
    {
        if (!(Hash::check($request->passwordcurrent, Auth::user()->password))) {
            $data['error'] = "Mật khẩu hiện tại của bạn không khớp với mật khẩu bạn đã cung cấp. Vui lòng thử lại.";
            return $this->sendResponse($data, 'success');
        }
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->save();
        $data['error'] = "Đổi Mật Khẩu Thành Công";
        return $this->sendResponse($data, 'ok');
    }

    public function favourite(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        if ($status) {
            Product::find($id)->increment('favourite');
            return User::find(Auth::id())->favourite()->attach($id);
        } else {
            Product::find($id)->decrement('favourite');
            return User::find(Auth::id())->favourite()->detach($id);
        }
    }

    public function resetPassword(Request $request)
    {
        $email = User::where('email', $request->email)->first();
        if ($email) {
            $token = $this->getTokenData($email);
            if ($token) {
                return response()->json(['warning' => 'Bạn đã gửi yêu cầu, xin vui lòng check mail!'], 200);
            } else {
                $token = Str::random(60);
                DB::table('password_resets')->insert([
                    'email' => $request->email,
                    'token' => $token,
                    'created_at' => Carbon::now()
                ]);
                resetPassword::dispatch($email, $token);
                
                return response()->json(['success' => 'Davichat đã gửi qua email với liên kết đặt lại mật khẩu của bạn!'], 200);
            }
        } else {
            return response()->json(['errors' => 'Thông tin không hơp lệ!'], 200);
        }
    }

    public function changePasswordToken(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $email = User::where('email', $request->email)->first();
        if ($email) {
            $token = $this->getTokenData($email);
            if ($request->token == $token) {
                $password = Hash::make($request->password);
                try {
                    User::where('email', $request->email)->update(['password' => $password]);
                    DB::table('password_resets')->where('email', $request->email)->delete();
                } catch (\Throwable $th) {
                    return response()->json(['errors' => 'Lỗi không xác định!'], 200);
                }
                return response()->json(['success' => 'Thay đổi mật khẩu thành công!'], 200);
            } else {
                return response()->json(['errors' => 'Thông tin không hơp lệ!'], 200);
            }
        } else {
            return response()->json(['errors' => 'Thông tin không hơp lệ!'], 200);
        }
    }

    // lấy token
    public function getTokenData($user)
    {
        $token = DB::table('password_resets')->where('email', $user->email)->first();
        if ($token) {
            $checkTime = $this->checkOutTime($user->email, $token->created_at);
            if ($checkTime) {
                return $token->token;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function checkToken(Request $request)
    {
        return (array) DB::table('password_resets')->where(['email' => $request->email, 'token' => $request->token])->first();
    }

    // kiểm tra thời hạn của token không vượt quá 60p
    public function checkOutTime($email, $time)
    {
        $time = Carbon::createFromFormat('Y-m-d h:i:s', $time);
        $difference = Carbon::now()->diffInMinutes($time);
        if ($difference > 60) {
            DB::table('password_resets')->where('email', $email)->delete();
            return false;
        } else {
            return true;
        }
    }
}
