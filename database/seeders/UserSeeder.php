<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'admin@admin.com',
            'password' => '$2y$10$sm3wH/.E/AOkQkjUPG6Bdu2bu86X8p/Qgk9rPneygnMqI8Vpj/ee.',
            'is_verified' => '1',
            'is_admin' => '1',
        ]);
        DB::table('users')->insert([
            'email' => 'ahar@ahar.com',
            'password' => '$2y$10$sm3wH/.E/AOkQkjUPG6Bdu2bu86X8p/Qgk9rPneygnMqI8Vpj/ee.',
        ]);
    }
}
