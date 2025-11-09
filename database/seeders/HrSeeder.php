<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class HrSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'HR Manager',
            'email' => 'hr@sikaper.com',
            'no_telp' => '081234567890',
            'password' => Hash::make('password'),
            'role' => 'hr',
        ]);
    }
}
