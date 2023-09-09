<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\Doctor::factory(20)->create();

        // \App\Models\User::create([
        //     'name' => 'mohammed',
        //     'email' => 'admin@admin.com',
        //     'password' => Hash::make('123456'),
        //     'phone' => '0569300640',
        //     'role' => 'admin',
        // ]);

        $this->call([
            // MajorSeeder::class,
            // DoctorSeeder::class,
        ]);
    }
}
