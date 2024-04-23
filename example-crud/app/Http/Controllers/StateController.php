<?php

namespace App\Http\Controllers;
use App\Models\State;


class StateController extends Controller
{
    public function getStates($country)
    {
        $states = State::where('country_id', $country)->pluck('name', 'id');
        return response()->json($states);
    }
}
