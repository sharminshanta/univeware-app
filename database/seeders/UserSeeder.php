<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'prefixname' => 'Mr',
            'firstname' => 'Devid',
            'lastname' => 'Gilmour',
            'username' => 'devid_gilmour',
            'email' => 'admin@gmail.com',
            'type' => 'admin',
            'password' => Hash::make('password'),
        ]);
    }
}
