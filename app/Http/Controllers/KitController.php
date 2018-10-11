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
            'declared_price' => 51700,
            'insurance' => 1,
            "insurance_agent_code" => "8001468510",
            'confirmation_price'    => 1,
            'have_doc'              => 1,

//            'pick_up' => [],
            'pick_up' => [
                'pickup_house'      => 'Дом другого адреса отправителя',
                'pickup_street'     => 'Улица другого адреса отправителя',
                'pickup_date'       => '2018-03-10',
                'pickup_time_start' => '12:00',
                'pickup_time_end'   => '13:59',
                'pickup_r'          => 1,
                'pickup_comment'    => 'test test test',
            ],

            'deliver' => [
                'delivery_date'         => '2018-03-14',
                'delivery_time_start'   => '12:00',
                'delivery_time_end'     => '14:00',
                'delivery_r'            => 1,
                'delivery_street'       => 'Ленина',
                'delivery_house'        => '25',
                'delivery_comment'      => 'test test test',
            ],

            'customer' => [

                'debitor_type' => 1,
                'country_code'          => 'RU',

                'real_country'          => 'Россия',
                'real_city'             => 'Иркутск',
                'real_street'           => 'Ленина',
                'real_house'            => '25',
                'real_contact_name'     => 'Фамилия Имя Отчество',
                'real_contact_phone'    => 88002345650,
                'real_supp'             => 'Б',
                'real_room'             => '24',
            ],

            'sender' => [

                'debitor_type'          => 2,
                'country_code'          => 'RU',

                'iin'                   => 123456789123,
                'name_ip'               => 'Фамилия Имя Отчество',
                'organization_name_ip'  => 'Фамилия Имя Отчество',
                'organization_phone_ip' => 88002345650,
                'phone_ip' => 88002345650,
                'inn_ip'                => 123456789123,
                'legal_country'         => 'Россия',
                'legal_city'            => 'Ангарск',
                'legal_street'          => 'Ленина',
                'legal_house'           => '25',
            ],

            'receiver' => [

                'debitor_type'          => 3,
                'country_code'          => 'RU',

                'kpp'                   => 123456789,
                'name_ur'               => 'Фамилия Имя Отчество',
                'organization_name_ur'  => 'ООО рога и копыта',
                'organization_phone_ur' => 88002345650,
                'phone_ur'              => 88002345650,
                'inn_ur'                => '7721575738',
                'legal_country'         => 'Россия',
                'legal_city'            => 'Ангарск',
                'legal_street'          => 'Ленина',
                'legal_house'           => '17',
            ],

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

        dd($service->create($data)->all());
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



