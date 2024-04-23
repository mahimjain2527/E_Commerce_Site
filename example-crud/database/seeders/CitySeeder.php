<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\State;



class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Gujarat = State::where('name', 'Gujarat')->first();
        $Rajasthan = State::where('name', 'Rajasthan')->first();
        $Maharashtra = State::where('name', 'Maharashtra')->first();
        $California = State::where('name', 'California')->first();
        $Texas = State::where('name', 'Texas')->first();
        $Florida = State::where('name', 'Florida')->first();




        City::create(['state_id' => $Gujarat->id, 'name' => 'Ahmedabad']);
        City::create(['state_id' => $Gujarat->id, 'name' => 'Surat']);
        City::create(['state_id' => $Gujarat->id, 'name' => 'Rajkot']);

        City::create(['state_id' => $Rajasthan->id, 'name' => 'Jaipur']);
        City::create(['state_id' => $Rajasthan->id, 'name' => 'Udaipur']);

        City::create(['state_id' => $Maharashtra->id, 'name' => 'Mumbai']);
        City::create(['state_id' => $Maharashtra->id, 'name' => 'Nashik']);

        City::create(['state_id' => $California->id, 'name' => 'Los Angeles']);
        City::create(['state_id' => $California->id, 'name' => 'San Diego']);

        City::create(['state_id' => $Texas->id, 'name' => 'Austin']);
        City::create(['state_id' => $Texas->id, 'name' => 'Texas City']);

        City::create(['state_id' => $Florida->id, 'name' => 'Miami']);
        City::create(['state_id' => $Florida->id, 'name' => 'Tampa']);






    }
}
