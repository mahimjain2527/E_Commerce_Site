<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('persons')->insert([
            
            [
                'name' => 'abc',
                'email' => 'abc@mail.com',
                'password' => 'abc',
            ],
            [
                'name' => 'def',
                'email' => 'def@mail.com',
                'password' => 'abc',
            ],
            [
                'name' => 'xyz',
                'email' => 'xyz@mail.com',
                'password' => 'abc',
            ],
            [
                'name' => 'pqr',
                'email' => 'pqr@mail.com',
                'password' => 'abc',
            ],
            [
                'name' => 'mno',
                'email' => 'mno@mail.com',
                'password' => 'abc',
            ],
            [
                'name' => 'ghi',
                'email' => 'ghi@mail.com',
                'password' => 'abc',
            ],
            [
                'name' => 'mahim',
                'email' => 'mahim@mail.com',
                'password' => 'abc',
            ],
            [
                'name' => 'dharmil',
                'email' => 'dharmil@mail.com',
                'password' => 'abc',
            ],
            [
                'name' => 'dharti',
                'email' => 'dharti@mail.com',
                'password' => 'abc',
            ],
            [
                'name' => 'deep',
                'email' => 'deep@mail.com',
                'password' => 'abc',
            ],

    ]);
    }
}
