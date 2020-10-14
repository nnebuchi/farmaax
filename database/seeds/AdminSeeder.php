<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'firstName' => 'Admin',
            'lastName' => 'Master',
            'phone' => '08121225275',
            'username' => 'admin',
            'lawyer' => 'yes',
            'email' => 'admin@mail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'isAdmin' => 1
        ]);
    }
}
