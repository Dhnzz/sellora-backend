<?php

namespace Database\Seeders;

use App\Models\{Role, User, Customer};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customer = Role::where('name', 'Customer')->first();
        
        $user = User::create([
            'email' => 'customer@gmail.com',
            'password' => Hash::make('customer123'),
            'role_id' => $customer->id,
            'is_active' => 0,
        ]);

        Customer::create([
            'name' => 'Customer',
            'phone' => '0812345678913',
            'address' => 'Alamat toko customer',
            'credit_limit' => 5000000,
            'payment_term' => 0,
            'user_id' => $user->id,
        ]);
    }
}
