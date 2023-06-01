<?php

namespace App\Http\Controllers;

use Stevebauman\Location\Facades\Location;

class LocationController extends Controller
{
    public function userDetails()
    {
        $ip = '27.7.89.10';
        $data = Location::get($ip);                
        return view('details',compact('data'));
    }
}
