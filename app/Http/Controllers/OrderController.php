<?php

namespace App\Http\Controllers;

use App\Services\Transports\Facades\Transport;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Modules\Orders\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function create_token(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->input('email'))->first();
        if (! $user || ! Hash::check($request->input('password'), $user->password)) {
            return [
                'error' => 'The provided credentials are incorrect.'
            ];
        }

        return $user->createToken($request->input('device_name'))->plainTextToken;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return bool|\Illuminate\Http\Client\Response|\Psr\Http\Message\ResponseInterface
     * @throws GuzzleException
     */
    public function index(Request $request)
    {
//        //Send order
//        $order = Order::find(51);
//        $res = Transport::channel('ghtk')->order($order)->sendOrder();
//        return json_decode($res, true);

//        Tính phí vận chuyển
        $arr = [
//            "pick_province" => "Tp Hà Nội",
//            "pick_district" => "Quận Hoàng Mai",
//            "province" => "Hà nội",
//            "district" => "Quận Cầu Giấy",
//            "address" => "P.503 tòa nhà Auu Việt, số 1 Lê Đức Thọ",
//            "weight" => 1000,
//            "value" => 3000000,
//            "transport" => "road",
//            "deliver_option" => "xteam",

            "address" => "Thôn cát tường",
            "deliver_option" => "xteam",
            "district" => "Huyện Bình Lục",
            "pick_district" => "Quận Hai Bà Trưng",
            "pick_province" => "Hà Nội",
            "province" => "Hà Nam",
            "transport" => "fly",
            "value" => 3000000,
            "weight" => 1000,
        ];
        $res = Transport::channel('ghtk')->order($arr)->shipFee();
        return $res;

//        $data = 'S1100156.HN25.AI4C.300035449';

        //Trạng thái đơn hàng
//        $res = Transport::channel('ghtk')->order($data)->orderStatus();

        //Hủy đơn hàng
//        $res = Transport::channel('ghtk')->order($data)->cancelOrder();

        //In nhãn đơn hàng
//        $res = Transport::channel('ghtk')->order($data)->printOrder();

        // Lấy danh sách địa chỉ lấy hàng
//        $res = Transport::channel('ghtk')->listAddressPickup();
//        return $res;


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
