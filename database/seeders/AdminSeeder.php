<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'mobile_no'=>'7001667213',
            'username' => 'admin',
            'address' => 'Kolkata,West Bengal',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now()

        ]);

    }
}
