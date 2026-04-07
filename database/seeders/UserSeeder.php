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
        User::factory()->create([
        'name' => 'admin',
        'email' => 'admin@gmail.com',
        'password' => Hash::make('123456'),
        'is_admin' => true
        ]);

        User::factory()->create([
            'name' => 'teste',
            'email' => 'teste@gmail.com',
            'password' => '123456',
            'is_admin' => false
        ]);
    }
}
