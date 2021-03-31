<?php

namespace App\Http\Controllers;

use App\Models\Booth;
use Illuminate\Http\Request;
use App\Services\Transports\Facades\Transport;
use GuzzleHttp\Exception\GuzzleException;

class TransportController extends Controller
{
    public function shipFee(Request $request)
    {
        $booth = Booth::find($request['id_booth']);

        $data = [
            "pick_province" => $booth->province->name,
            "pick_district" => $booth->district->name,
            "pick_ward"  => $booth->ward->name,
            "pick_address" => $booth->address,
            "province" => $request['province'],
            "district" => $request['district'],
            "address" => $request['address'],
            "ward"    => $request['ward'],
            "weight" => $request['weight'],
            "value" => 3000000,
            "transport" => "road",
            "deliver_option" => "none"
        ];
        $res = Transport::channel('ghtk')->order($data)->shipFee();
        return $res;
    }
}
