<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'مدیر 1',
            'lastname' => 'احمدی',
            'phone' => '09123456789',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('11111111'),
        ]);
        User::create([
            'name' => 'سرپرست 1',
            'lastname' => 'امیری',
            'phone' => '09923456780',
            'email' => 'supervisor1@gmail.com',
            'password' => Hash::make('11111111'),
        ]);
        User::create([
            'name' => 'کاربر 1',
            'lastname' => 'اصغری',
            'phone' => '09323456700',
            'email' => 'user1@gmail.com',
            'password' => Hash::make('11111111'),
        ]);
        User::create([
            'name' => 'کاربر 2',
            'lastname' => 'محمدی',
            'phone' => '09003456781',
            'email' => 'user2@gmail.com',
            'password' => Hash::make('11111111'),
        ]);
        User::create([
            'name' => 'کاربر 3',
            'lastname' => 'رضائی',
            'phone' => '09223456722',
            'email' => 'user3@gmail.com',
            'password' => Hash::make('11111111'),
        ]);
    }
}
