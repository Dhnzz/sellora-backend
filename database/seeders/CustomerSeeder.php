<?php

namespace Database\Seeders;

use App\Models\{User, Customer};
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
        $user = User::create([
            'email' => 'customer@gmail.com',
            'password' => Hash::make('customer123'),
            'is_active' => 0,
        ]);

        $user->assignRole('customer');

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
