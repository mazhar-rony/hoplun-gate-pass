<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Mazhar',
            'email' => 'mazhar@test.com',
            'role' => 2,
            'department_id' => 1,
            'designation_id' => 1,
            'manager_id' => 1,
            'building_id' => 1,
            'status' => 1,
            'password' => Hash::make('password'), // Make sure to hash the password
        ]);
        User::create([
            'name' => 'Fahim',
            'email' => 'fahim@test.com',
            'role' => 3,
            'department_id' => 1,
            'designation_id' => 1,
            'manager_id' => 1,
            'building_id' => 1,
            'status' => 1,
            'password' => Hash::make('password'), // Make sure to hash the password
        ]);
        User::create([
            'name' => 'Omar',
            'email' => 'omar@test.com',
            'role' => 3,
            'department_id' => 1,
            'designation_id' => 1,
            'manager_id' => 1,
            'building_id' => 1,
            'status' => 1,
            'password' => Hash::make('password'), // Make sure to hash the password
        ]);
        User::create([
            'name' => 'Imran',
            'email' => 'imran@test.com',
            'role' => 3,
            'department_id' => 1,
            'designation_id' => 1,
            'manager_id' => 1,
            'building_id' => 1,
            'status' => 1,
            'password' => Hash::make('password'), // Make sure to hash the password
        ]);
        User::create([
            'name' => 'Tanvir',
            'email' => 'tanvir@test.com',
            'role' => 1,
            'department_id' => 1,
            'designation_id' => 1,
            'manager_id' => 1,
            'building_id' => 1,
            'status' => 1,
            'password' => Hash::make('password'), // Make sure to hash the password
        ]);
    }
}
