<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_details')->insert([
            'user_id' => '2',
            'name' => 'Muhd Haziq',
            'age' => '23',
            'address' => 'Lot 1105, Lorong 20, RPR Batu Kawa',
            'postcode' => '93250',
            'city' => 'Kuching',
            'state' => 'Sarawak',
            'phone_number' => '01125038079',
            'income' => '1100',
            'occupation' => 'General Worker',
            'household_member' => '3',
            'bio' => 'I am in need of aids due to current pandemic.',
        ]);
    }
}
