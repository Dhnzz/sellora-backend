<?php

namespace Database\Seeders;

use App\Models\{Role, User, Admin};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sales = Role::where('name', 'Sales')->first();
        
        $user = User::create([
            'email' => 'sales@gmail.com',
            'password' => Hash::make('sales123'),
            'role_id' => $sales->id,
            'is_active' => 0,
        ]);
        
        Admin::create([
            'name' => 'Sales',
            'phone' => '0812345678912',
            'user_id' => $user->id,
        ]);
    }
}
