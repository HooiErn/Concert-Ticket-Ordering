<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'role' => 1,
            'password' => Hash::make('12345'),
            'email' => 'admin@gmail.com',
            'contact_number' => '012-21345678',
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Andy',
            'role' => 2,
            'password' => Hash::make('12345'),
            'email' => 'andy@gmail.com',
            'contact_number' => '016-21345671',
            'remember_token' => Str::random(10),
        ]);
    }
}
