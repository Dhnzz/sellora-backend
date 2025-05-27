<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = [
            ['name' => 'Admin', 'description' => 'Admin'],
            ['name' => 'Sales', 'description' => 'Sales'],
            ['name' => 'Customer', 'description' => 'Customer'],
        ];
        
        foreach ($role as $r) {
            Role::create($r);
        }
    }
}
