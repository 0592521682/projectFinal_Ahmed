<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Customer;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        foreach ([
            ['Ahmed', 'ahmed@example.com'],
            ['Sara', 'sara@example.com'],
            ['Omar', 'omar@example.com'],
            ['Lina', 'lina@example.com'],
        ] as [$name, $email]) {
            User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('password'),
                'role' => 'technician',
            ]);
        }

        Customer::create([
            'name' => 'Customer One',
            'email' => 'customer@example.com',
            'phone' => '0599000000',
            'address' => 'Gaza',
        ]);
    }
}