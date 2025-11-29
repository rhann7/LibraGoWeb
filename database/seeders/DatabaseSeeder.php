<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::create([
            'name'     => 'Admin',
            'username' => 'adminlibrago',
            'email'    => 'admin@email.com',
            'password' => Hash::make('password'),
            'role'     => 'admin'
        ]);
        
        User::create([
            'name'     => 'User Test',
            'username' => 'usertest',
            'email'    => 'user@email.com',
            'password' => Hash::make('password'),
            'role'     => 'user'
        ]);
    }
}