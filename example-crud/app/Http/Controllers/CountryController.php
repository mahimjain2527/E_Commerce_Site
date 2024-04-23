<?php

namespace App\Http\Controllers;
use App\Models\Country;

use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function getCountries()
    {
        $countries = Country::pluck('country_name', 'id');
        return response()->json($countries);
    }
}
