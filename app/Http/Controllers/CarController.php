<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class CarController extends Controller
{
    public function index()
{
    $carsJson = Storage::disk('public')->get('cardata.json');
    $serJson = Storage::disk('public')->get('Servicing-Data.json');

    $cars = json_decode($carsJson, true);
    $ser = json_decode($serJson, true);


    $carList = isset($cars['Cars']) ? $cars['Cars'] : [];
    $serlist=isset($ser['Cars']) ? $ser['Cars'] : [];
    $response = Http::get('https://apicars.prisms.in/user/getall');
    $users = $response->successful() ? $response->json()['Users'] : [];
    return view('usermanagement', ['cars' => $carList, 'users' => $users,'ser'=>$serlist] );
}


public function userInfo($id)
{
    $response = Http::get("https://apicars.prisms.in/user/get/{$id}");

    if ($response->successful()) {
        $user = $response->json()['User']; 
        return view('userinfo', compact('user'));
    } else {
        abort(404);
    }
}
}
