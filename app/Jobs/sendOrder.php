<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\Transports\Facades\Transport;
use App\Models\Order;

class sendOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public $order_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($order_id)
    {
        $this->order_id = $order_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $order = Order::findOrFail($this->order_id);
        $channel = $order->transport->key;

        if(!$channel)
            $channel = 'Ghtk';
        $resultTransport = Transport::channel($channel)->order($order)->sendOrder();
        $transport = json_decode($resultTransport, true);
        if($transport['success'] === true){
            $res = $transport['order'];
            $order['status_id_delivery']        =  $res['status_id'];
            $order['estimated_pick_time']       =  $res['estimated_pick_time'];
            $order['estimated_deliver_time']    =  $res['estimated_deliver_time'];
            $order['id_delivery']               =  $res['label'];
            $order['tracking_id_delivery']      =  $res['tracking_id'];
            $order['ship_price']                =  $res['fee'];
            $order['sorting_code_delivery']     =  $res['sorting_code'];
            $order['package_name_freight']      =  $res['area'];
            $order->save();
        }
    }
}
