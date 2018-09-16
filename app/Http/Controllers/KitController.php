<?php

namespace App\Http\Controllers;

use App\Http\Requests\KitRequest;
use Webadvance\Kitapiv2\KitService;
use Webadvance\Kitapiv2\Order\Calculate;
use Webadvance\Kitapiv2\Order\Currency;
use Webadvance\Kitapiv2\Order\Insurance;
use Webadvance\Kitapiv2\Tdd\City;

class KitController extends Controller
{
    public function index()
    {
        $service = new KitService();

        $insurance = $service->post(new Insurance());

        return view('index', [

            'cities' => $service->post(new City()),
            'currencies' => $service->post(new Currency()),
            'insurance' => $insurance->agent,
            'price' => 0,
        ]);
    }

    public function calculate(KitRequest $request)
    {
        $service = new KitService();

        $result = $service->post((new Calculate($request->all())));

        $insurance = $service->post(new Insurance());

        if (isset($result[0]->standart)) { $price = $result[0]->standart->cost; }
        if (isset($result[0]->economy)) { $price = $result[0]->economy->cost; }
        if (isset($result[0]->express)) { $price = $result[0]->express->cost; }
        if (isset($result[0]->standard_courier)) { $price = $result[0]->standard_courier->cost; }
        if (isset($result[0]->express_courier)) { $price = $result[0]->express_courier->cost; }
        
        $price = isset($price) ? $price : 'цена не пришла';

        return view('index', [

            'cities' => $service->post(new City()),
            'currencies' => $service->post(new Currency()),
            'insurance' => $insurance->agent,
            'price' => $price,
        ]);
    }
}



