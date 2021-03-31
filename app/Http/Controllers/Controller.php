<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use App\Events\Notifications;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $permissions = [];

    public function __construct()
    {
        foreach ($this->permissions as $permission => $methods) {
            $this->middleware("role_or_permission:admin|{$permission}")->only($methods);
        }
    }

    /**
     * @param $result
     * @param $message
     * @return JsonResponse
     */
    public function sendResponse($result, $message=null)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message
        ];

        return response()->json($response, 200);
    }

    /**
     * @param $error
     * @param array $errorMessages
     * @param int $code
     * @return JsonResponse
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    public function pushNotification($array)
    {
        if(count($array)){
            $notification = new Notification();
            $notification->fill($array);
//            $notification = $array['to_id'];
//            $notification->to_name  = $array['to_name'];
//            $notification->from_name= $array['from_name'];
//            $notification->from_id  = $array['from_id'];
//            $notification->title    = $array['title'];
//            $notification->content  = $array['content'];
//            $notification->type     = $array['type'];
            $notification->save();

            Notifications::dispatch($notification->title);

            return true;
        }
        return false;
    }
}
