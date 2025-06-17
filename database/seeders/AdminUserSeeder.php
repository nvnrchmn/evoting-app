<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name'     => 'Admin',
                'password' => Hash::make('password'), // Ganti dengan password yang kamu mau
                'role'     => 'admin',                // pastikan kolom 'role' ada di tabel users
            ]
        );
    }
}
