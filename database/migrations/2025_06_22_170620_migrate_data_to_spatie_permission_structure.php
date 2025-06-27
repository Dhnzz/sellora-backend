<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Role::create(['name' => 'admin']);
        // Role::create(['name' => 'sales']);
        // Role::create(['name' => 'customer']);

        // $users = User::whereNotNull('role_id')->get();

        // foreach ($users as $user) {
        //     if ($user->role_id == 1) {
        //         // Asumsi ID 1 adalah admin
        //         $user->assignRole('admin');
        //     } elseif ($user->role_id == 2) {
        //         // Asumsi ID 2 adalah salesperson
        //         $user->assignRole('salesperson');
        //     } elseif ($user->role_id == 3) {
        //         // Asumsi ID 3 adalah manager
        //         $user->assignRole('manager');
        //     }
        // }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('spatie_permission_structure', function (Blueprint $table) {
            //
        });
    }
};
