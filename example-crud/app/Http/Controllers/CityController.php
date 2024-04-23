<?php

namespace App\Http\Controllers;
use App\Models\City;

use Illuminate\Http\Request;

class CityController extends Controller
{
    public function getCities($state)
    {
        $cities = City::where('state_id', $state)->pluck('name', 'id');
        return response()->json($cities);
    }
}
