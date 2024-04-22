<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User;
        $user->name = "admin";
        $user->email = "admin@gmail.com";
        $user->password = bcrypt("Google@123");
        $user->two_factor_secret = "123123";
        $user->save();
        $user->assignRole('admin');


        $user = new User;
        $user->name = "user";
        $user->email = "user@gmail.com";
        $user->password = bcrypt("Google@123");
        $user->two_factor_secret = "123123";
        $user->save();
        $user->assignRole('user');
    }
}
