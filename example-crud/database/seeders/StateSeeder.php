<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\State;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $India = Country::where('country_name', 'India')->first();
        $US = Country::where('country_name', 'US')->first();

        State::create(['country_id' => $India->id, 'name' => 'Gujarat']);
        State::create(['country_id' => $India->id, 'name' => 'Maharashtra']);
        State::create(['country_id' => $India->id, 'name' => 'Rajasthan']);
       

        State::create(['country_id' => $US->id, 'name' => 'California']);
        State::create(['country_id' => $US->id, 'name' => 'Texas']);
        State::create(['country_id' => $US->id, 'name' => 'Florida']);




    }
}
