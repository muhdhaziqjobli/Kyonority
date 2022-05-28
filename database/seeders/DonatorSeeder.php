<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DonatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('donators')->insert([
            'email' => 'adi@adi.com',
            'password' => '$2y$10$sm3wH/.E/AOkQkjUPG6Bdu2bu86X8p/Qgk9rPneygnMqI8Vpj/ee.',
            'phone_number' => '01140207828'
        ]);
    }
}
