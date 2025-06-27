<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Reset cached roles and permissions
        // Ini penting untuk memastikan cache diperbarui saat seeder dijalankan
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Manajemen Admin
        Permission::create(['name' => 'view-admin']);
        Permission::create(['name' => 'create-admin']);
        Permission::create(['name' => 'update-admin']);
        Permission::create(['name' => 'delete-admin']);

        // Manajemen Sales
        Permission::create(['name' => 'view-sales']);
        Permission::create(['name' => 'create-sales']);
        Permission::create(['name' => 'update-sales']);
        Permission::create(['name' => 'delete-sales']);

        // Manajemen Customer
        Permission::create(['name' => 'view-customers']);
        Permission::create(['name' => 'create-customers']);
        Permission::create(['name' => 'update-customers']);
        Permission::create(['name' => 'delete-customers']);

        // Manajemen Supplier
        Permission::create(['name' => 'view-suppliers']);
        Permission::create(['name' => 'create-suppliers']);
        Permission::create(['name' => 'update-suppliers']);
        Permission::create(['name' => 'delete-suppliers']);

        // Manajemen Produk Group
        Permission::create(['name' => 'view-product-groups']);
        Permission::create(['name' => 'create-product-groups']);
        Permission::create(['name' => 'update-product-groups']);
        Permission::create(['name' => 'delete-product-groups']);

        // Manajemen Produk Unit
        Permission::create(['name' => 'view-product-units']);
        Permission::create(['name' => 'create-product-units']);
        Permission::create(['name' => 'update-product-units']);
        Permission::create(['name' => 'delete-product-units']);

        // Manajemen Produk
        Permission::create(['name' => 'view-products']);
        Permission::create(['name' => 'create-products']);
        Permission::create(['name' => 'update-products']);
        Permission::create(['name' => 'delete-products']);

        // Manajemen Stock Adjustment
        Permission::create(['name' => 'view-stock-adjustment']);
        Permission::create(['name' => 'create-stock-adjustment']);
        Permission::create(['name' => 'update-stock-adjustment']);
        Permission::create(['name' => 'delete-stock-adjustment']);

        // Manajemen Purchase
        Permission::create(['name' => 'view-purchase-orders']);
        Permission::create(['name' => 'create-purchase-orders']);
        Permission::create(['name' => 'update-purchase-orders']);
        Permission::create(['name' => 'delete-purchase-orders']);

        // Manajemen Sales Order
        Permission::create(['name' => 'view-sales-orders']);
        Permission::create(['name' => 'create-sales-orders']);
        Permission::create(['name' => 'update-sales-orders']);
        Permission::create(['name' => 'delete-sales-orders']);

        // Manajemen Sales Return
        Permission::create(['name' => 'view-sales-returns']);
        Permission::create(['name' => 'create-sales-returns']);
        Permission::create(['name' => 'update-sales-returns']);
        Permission::create(['name' => 'delete-sales-returns']);

        // Super Admin Role
        $superAdmin = Role::create(['name' => 'superAdmin']);

        // Admin Role
        $admin = Role::create(['name' => 'admin']);
        $excludedPermission = [
            'view-admin',
            'create-admin',
            'update-admin',
            'delete-admin',
        ];
        
        $allPermission = Permission::pluck('name');
        $adminPermission = $allPermission->diff($excludedPermission);

        $admin->syncPermissions($adminPermission);

        // Sales Role
        $sales = Role::create(['name' => 'sales']);
        $sales->givePermissionTo([
            // Product
            'view-products',

            // Sales Order
            'view-sales-orders',
            'create-sales-orders',
            'update-sales-orders',

            // Sales Return
            'view-sales-returns',
            'create-sales-returns',
        ]);

        // Customer Role
        $customer = Role::create(['name' => 'customer']);
        $customer->givePermissionTo([
            // Product
            'view-products',

            // Sales Order
            'view-sales-orders',
            'create-sales-orders',
        ]);
    }
}
