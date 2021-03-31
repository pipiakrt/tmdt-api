<?php
namespace App\Services\Transports\Drivers;

use GuzzleHttp\Client;

class GhtkDriver extends Driver
{

    /**
     * The phone number this sms should be sent from.
     *
     * @var string
     */
    private $url = 'https://services.ghtklab.com';
    private $token = 'E110BBA0635F5495b672897caad1f9B8A2437A91';

    private function client(){
        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'token' => $this->token
            ]
        ]);

        return $client;
    }
    /**
     * {@inheritdoc}
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendOrder()
    {
        $body = [
            'products' => [],
            'order' => [
                "id"=> 'od_'.$this->order->id,
                "pick_name"=> $this->order->booth->name,
                "pick_address"=> $this->order->booth->address,
                "pick_province"=> $this->order->booth->province->name,
                "pick_district"=> $this->order->booth->district->name,
                "pick_ward"=> $this->order->booth->ward->name,
                "pick_tel"=> $this->order->booth->phone,

                "tel"=> $this->order->guest_phone,
                "name"=> $this->order->guest_name,
                "address"=> $this->order->guest_address,
                "province"=> $this->order->province->name,
                "district"=> $this->order->district->name,
                "ward"=> $this->order->ward->name,
                "hamlet"=> "Khác",
                "is_freeship"=> "0",
                "pick_money"=> $this->order->status_pay ? 0 : (int)$this->order->total,
                "note"=> $this->order->note,
                "value"=> 3000000,
                "transport"=> "road",
                "pick_option"=>"cod",
                "deliver_option" => "none",
                "pick_session" => 2
            ]
        ];

        foreach ($this->order->products as $product) {
            $name = $product->name;
            if($product['classification_group_one']){
                $name = $name.'-'.$product['pivot']['name_product_attribute'];
                if($product['classification_group_two']){
                    $name = $name.'-'.$product['pivot']['name_attribute_detail'];
                }
            }
            $body['products'][] = [
                "name"=> $name,
                "weight"=> $product['weight'] / 1000,
                "quantity"=> (int)$product['pivot']['quantity'],
                "product_code"=> 'PD_'.$product->id
            ];
        }
        $client = $this->client();

        $response = $client->post($this->url.'/services/shipment/order',
            ['body' => json_encode($body)]
        );

        return $response->getBody();
    }
    public function shipFee(){
        $data =  $this->order;
        $client = $this->client();

        $response = $client->get($this->url.'/services/shipment/fee?'.http_build_query($data));

        return $response->getBody();
    }
    public function statusOrder()
    {
        $data =  $this->order;
        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'token' => $this->token
            ]
        ]);
        $response = $client->get($this->url.'/services/shipment/v2/'.$data);

        return $response->getBody();
    }
    public function cancelOrder()
    {
        $data =  $this->order;
        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'token' => $this->token
            ]
        ]);
        $response = $client->post($this->url.'/services/shipment/cancel/'.$data);

        return $response->getBody();
    }

    public function printOrder()
    {
        $data =  $this->order;
        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'token' => $this->token
            ]
        ]);
        $response = $client->get($this->url.'/services/label/'.$data);

        return $response->getBody();
    }

    public function listAddressPickup()
    {
        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'token' => $this->token
            ]
        ]);
        $response = $client->get($this->url.'/services/shipment/list_pick_add');

        return $response->getBody();
    }
}
