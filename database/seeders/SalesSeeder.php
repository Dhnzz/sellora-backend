<?php

namespace Database\Seeders;

use App\Models\{User, Sales};
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
        $user = User::create([
            'email' => 'sales@gmail.com',
            'password' => Hash::make('sales123'),
            'is_active' => 0,
        ]);

        $user->assignRole('sales');
        
        Sales::create([
            'name' => 'Sales',
            'phone' => '0812345678912',
            'user_id' => $user->id,
        ]);
    }
}
