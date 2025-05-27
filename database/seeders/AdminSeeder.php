<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{User, Admin, Role};
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::where('name', 'Admin')->first();
        
        $user = User::create([
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role_id' => $admin->id,
            'is_active' => 0,
        ]);
        
        Admin::create([
            'name' => 'Admin',
            'phone' => '0812345678911',
            'user_id' => $user->id,
        ]);
    }
}
