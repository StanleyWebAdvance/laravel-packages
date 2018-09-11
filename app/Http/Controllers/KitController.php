<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stanleyvv\Apikit\KitService;


class KitController extends Controller
{
    public function index()
    {
        return view('index', [
            'stan' => KitService::talkToMe()
        ]);
    }
}
