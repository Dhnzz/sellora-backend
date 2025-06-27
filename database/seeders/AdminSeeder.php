<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{User, Admin};
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat user super admin
        $userSuperAdmin = User::create([
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('superadmin123'),
            'is_active' => 0,
        ]);
        $userSuperAdmin->assignRole('superAdmin');
        Admin::create([
            'name' => 'Super Admin',
            'phone' => '0812345678911',
            'user_id' => $userSuperAdmin->id,
        ]);

        // Membuat user admin
        $userAdmin = User::create([
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'is_active' => 0,
        ]);
        $userAdmin->assignRole('admin');
        Admin::create([
            'name' => 'Admin',
            'phone' => '0812345678910',
            'user_id' => $userAdmin->id,
        ]);
    }
}
