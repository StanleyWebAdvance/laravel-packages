<?php

namespace App\Http\Controllers;

use App\Http\Requests\KitRequest;
use Webadvance\Kitapiv2\KitService;

class KitController extends Controller
{
    public function index()
    {
        $service = new KitService();

        return view('index', [

            'cities' => $service->cityTdd()->all(),
            'currencies' => $service->currency()->all(),
            'insurance' => $service->insurance()->agent(),
            'price' => 0,
        ]);
    }

    public function calculate(KitRequest $request)
    {
        $service = new KitService();



        return view('index', [

            'cities' => $service->cityTdd()->all(),
            'currencies' => $service->currency()->all(),
            'insurance' => $service->insurance()->agent(),
            'price' => $service->calculate($request->all())->standart()->cost
        ]);
    }
}



