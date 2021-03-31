<?php

namespace Modules\Orders\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use App\Models\OrderHistory;
use App\Models\ProductAttribute;
use App\Models\User;
use Modules\AddressUsers\Models\AddressUser;
use Modules\AttributeDetails\Models\AttributeDetail;
use Modules\Booths\Models\Booth;
use Modules\Orders\Resources\Orders as OrdersResource;
use Modules\Orders\Resources\Order as OrderResource;
use Modules\Orders\Models\Order;
use Illuminate\Http\Request;
use App\Jobs\SendEmailOrder;
use App\Jobs\sendOrder;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use App\Services\Transports\Facades\Transport;
use Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $listOrder = $request->input('listOrders');
        $data = $request->only(
            'guest_name',
            'guest_phone',
            'guest_email',
            'guest_address',
            'province_id',
            'district_id',
            'ward_id',
            'transport_id',
            'status_pay',
            'user_id',
            'payment_id',
        );
        //2-> Thanh toán bằng ví của shop
        $user = User::findOrFail($data['user_id']);

        if($data['payment_id'] === 2){
            if($user['wallet'] >= $request['total_price_order']){
                $user['wallet'] -= $request['total_price_order'];
            }
            $user->save();
            $data['status_pay'] = 1;
        }

        if(count($listOrder)){
            foreach ($listOrder as $key_order => $value){
                $total = 0;
                $data['booth_id'] = $value['id_booth'];
                $data['note'] = $value['note'];
                $data['ship_price'] = $value['price_ship'];

                $order = new Order();
                $order->fill($data);
                $order->save();

                foreach ($value['products'] as $product){
                    $orderDetail = new OrderDetail();
                    $orderDetail['product_id'] = $product['id'];
                    $orderDetail['order_id'] = $order['id'];
                    $orderDetail['quantity'] = $product['qty'];
                    $orderDetail['price'] = $product['price'];
                    $orderDetail['product_attribute_id'] = $product['proAttrId'];
                    $orderDetail['attribute_detail_id'] = $product['attrDetailId'];
                    $orderDetail['name_product_attribute'] = $product['proAttrName'];
                    $orderDetail['name_attribute_detail'] = $product['attrDetailName'];
                    $total += $product['total'];
                    $orderDetail->save();

                    if($orderDetail['attribute_detail_id']){
                        $attributeDetail = AttributeDetail::findOrFail($orderDetail['attribute_detail_id']);
                        $attributeDetail['amount'] -= $orderDetail['quantity'];
                        $attributeDetail->save();
                    }else if($orderDetail['product_attribute_id']){
                        $productAttribute = ProductAttribute::findOrFail($orderDetail['product_attribute_id']);
                        $productAttribute['amount'] -= $orderDetail['quantity'];
                        $productAttribute->save();
                    }else{
                        $product = Product::findOrFail($product['id']);
                        $product['amount'] -= $orderDetail['quantity'];
                        $product->save();
                    }
                }
                $order['total'] = $total;
                $order['code'] = mt_rand(10000,999999).$order['id'];
                $order->save();

                //Gửi notifice cho admin
                $notification = [];
                $notification['status'] = 0;
                $notification['from_name'] = $user['name'];
                $notification['from_id'] = $data['user_id'];
                $notification['to_id'] = 1;
                $notification['to_name'] = 'Admin';
                $notification['title'] = 'Có đơn hàng mới';
                $notification['content'] = $user['name'].' vừa tạo đơn hàng mới mới <a target="_bank" href="/admin/orders?key='.$order['code'].'">chi tiết</a>';
                $notification['type'] = 2;

                $this->pushNotification($notification);
                $booth = Booth::findOrFail($value['id_booth']);
                $notifi = [];
                $notifi['status'] = 0;
                $notifi['to_id'] = $value['id_booth'];
                $notifi['to_name'] = $booth->name;
                $notifi['title'] = 'Có đơn hàng mới';
                $notifi['content'] = 'Đơn hàng mới có mã là #'.$order['code'];
                $notifi['type'] = 4;
                $notifi['classify'] = 0;

                $this->pushNotification($notifi);
            }
        }   
        Log::debug($request->all());
        SendEmailOrder::dispatch($request->all());

        return $this->sendResponse(true, 'success');
    }

    public function list(Request $request) {
        if ($request->status == 0)
            return OrdersResource::collection(Order::where('booth_id', $request->user()->booth_id)->get());
        return OrdersResource::collection(Order::where('status', $request->status)->where('booth_id', $request->user()->booth_id)->get());
    }

    public function index(Request $request)
    {
 
        return OrdersResource::collection(Order::paginateFilter($request));
    }

    public function show($id)
    {
        return new OrdersResource(Order::findOrFail($id));
    }
    public function changeStatus(Request $request)
    {
        $listId = $request->id;
        $status = $request->status;
        $history = $request->history;
        Order::whereIn('id', $listId)->update(['status' => $status]);
        OrderHistory::insert($history);

        foreach ($listId as $order_id){
            sendOrder::dispatch($order_id);
        }
        return $this->sendResponse(true, 'success');
    }

    public function statistical($id)
    {
        $query = Order::where('booth_id', $id)->get();
        
        $data['count'] = $query->count();
        $data['cancel'] = $query->where('status', 4)->count();
        $data['totalSuccess'] = $query->where('status', 5)->count();
        $data['total'] = $query->where('status', 5)->sum(function ($i) { return $i->total; });
        
        $query = Product::where('booth_id', $id)->get();
        $data['censorship'] = $query->where('status', 1)->count();
        $data['delivery'] = $query->where('status', 3)->count();
        $data['countProduct'] = $query->count();

        return $data;
    }

    public function revenue($id, Request $request)
    {
        $month = \Carbon\Carbon::now()->month;

        $paid = Order::where(['booth_id' => $id, 'status' => 5]);
        if ($request->paid) 
        {
            return [
                'paid' => OrdersResource::collection($paid->paginate(7)),
            ];
        }

        $will_pay = Order::where('booth_id', $id)->whereIn('status', [2,3]);
        if ($request->will_pay)
        {
            return [
                'will_pay' => OrdersResource::collection($will_pay->paginate(7)),
            ];
        }
        
        return [
            'count_paid' => $paid->count(),
            'count_will_pay' => $will_pay->count(),

            'total_paid' => $paid->get()->sum(function ($i) { return $i->total; }),
            'total_will_pay' => $will_pay->get()->sum(function ($i) { return $i->total; }),

            'paid' => OrdersResource::collection($paid->paginate(7)),
            'will_pay' => OrdersResource::collection($will_pay->paginate(7)),

            'total_paid_month' => $paid->whereMonth('created_at', $month)->get()->sum(function ($i) { return $i->total; }),
            'total_will_pay_month' => $will_pay->whereMonth('created_at', $month)->get()->sum(function ($i) { return $i->total; }),
        ];
    }

    public function shipper($id)
    {
        return Transport::channel('ghtk')->order($id)->statusOrder();
    }
}