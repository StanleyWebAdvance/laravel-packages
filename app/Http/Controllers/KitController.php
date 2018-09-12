<?php

namespace App\Http\Controllers;

use Hamcrest\Core\Is;
use Illuminate\Http\Request;
use Stanleyvv\Apikit\Functions\Get_city_list;
use Stanleyvv\Apikit\Functions\Is_city;
use Stanleyvv\Apikit\Functions\Price_order;
use Stanleyvv\Apikit\KitService;


class KitController extends Controller
{
    public function index()
    {
        $function = new Is_city('www');
        $service = new KitService();

        dd($service->responsePost($function));

//        return view('index', [
//
//            'stan' => $service->response($function)
//        ]);
    }
}



