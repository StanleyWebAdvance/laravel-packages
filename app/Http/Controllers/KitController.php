<?php

namespace App\Http\Controllers;

use App\Http\Requests\KitRequest;
use Wstanley\Kitapi\KitService;


class KitController extends Controller
{
    public function index()
    {
//        $service = new KitService();

//        dd($service->schedule()->all());

        return view('index', [

            'cities' => array(), // $service->cityTdd()->all(),
            'currencies' => array(), // $service->currency()->all(),
            'insurance' => array(), // $service->insurance()->agent(),
            'price' => 0,
        ]);
    }

    public function order()
    {
        $service = new KitService();

        $data = [

            'city_pickup_code' => '660000100000',
            'city_delivery_code' => '000000000001',
            'type' => 1,
            'declared_price' => 500,
//            'insurance' => true,
            'customer' => [

                'debitor_type' => 1,

                'country_code'          => '1',
                'real_country'          => '1',
                'real_city'             => '1',
                'real_street'           => '1',
                'real_house'            => '1',

                'real_contact_name'     => '1',
                'real_contact_phone'    => '1',
            ],
            'sender' => 'rrr',
            'receiver' => [],
            "count_place" => [
                0 => "1"
            ],
            "weight" => [
                0 => "2"
            ],
            "volume" => [
                0 => "8"
            ],
        ];

        dd($service->create($data));
    }

    public function calculate(KitRequest $request)
    {
        $service = new KitService();

//        $data = [
//            "city_pickup_code" => "000000000002",
//            "city_delivery_code" => "010000000001",
//            "count_place" => [
//                0 => "1"
//            ],
//            "weight" => [
//                0 => "2"
//            ],
//            "height" => [
//                0 => "2"
//            ],
//            "volume" => [
//                0 => "8"
//            ],
//            "declared_price" => "12221",
//            "insurance" => "on",
//            "insurance_agent_code" => "8001468510",
//            "currency_code" => [
//                0 => "BYN",
//            ]];


        return view('index', [

            'cities' => $service->cityTdd()->all(),
            'currencies' => $service->currency()->all(),
            'insurance' => $service->insurance()->agent(),
            'price' => $service->calculate($request->all(), false)->standart()->cost
        ]);
    }
}



