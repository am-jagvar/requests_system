<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** taein naghash admin be user moshakhas */
        $user = User::where('email','admin1@gmail.com')->first();
        $user->assignRole('Admin');

        /** taein naghash sarparast be user moshakhas */
        $user = User::where('email','supervisor1@gmail.com')->first();
        $user->assignRole('Supervisor');

        /** taein naghash karbar addi be user moshakhas */
        $user = User::where('email','user1@gmail.com')->first();
        $user->assignRole('Normal');
        $user = User::where('email','user2@gmail.com')->first();
        $user->assignRole('Normal');
        $user = User::where('email','user3@gmail.com')->first();
        $user->assignRole('Normal');
    }
}
