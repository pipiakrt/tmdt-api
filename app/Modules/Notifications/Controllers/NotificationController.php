<?php

namespace Modules\Notifications\Controllers;

use App\Http\Controllers\Controller;
use Modules\Account\Models\User;
use Modules\Booths\Models\Booth;
use Modules\Notifications\Resources\Notifications as NotificationsResource;
use Modules\Notifications\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        if($request->id)
        {
            $notification = Notification::find($request->id);
            $notification->update(['status' => 1]);
            return $notification;
        }
        else if ($request->limit) 
        {
            $user = User::find($request->owner);
            $query = Notification::where(
                [
                    'status' => 0,
                    'to_id' => (int)$request->owner,
                    'type' => 1
                ])->orWhere(['to_id' => $user['booth_id'],  'type' => 4])
                ->orderBy('id', 'DESC')->get()->toArray();

            $data['notification'] = array_slice($query, 0, 5, true);
            $data['count'] = count($query);
            return response()->json($data, 200);
        }
        else
        {
            $notifications = Notification::where(['to_id' => (int)$request->owner, 'type' => 1 ])->orderBy('_id', 'DESC')->paginate(10);
            return NotificationsResource::collection($notifications);
        }
    }
}
