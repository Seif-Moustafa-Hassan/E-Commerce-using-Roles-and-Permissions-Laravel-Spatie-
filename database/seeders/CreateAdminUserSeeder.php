<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // --- Create Roles ---
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole  = Role::firstOrCreate(['name' => 'user']);

        // --- Get all permissions ---
        $allPermissions = Permission::pluck('id','id')->all();

        // Assign all permissions to both roles
        $adminRole->syncPermissions($allPermissions);
        $userRole->syncPermissions($allPermissions);

        // --- Create Admin User ---
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'roles_name' => ["admin"], // optional, remove if column doesn't exist
            'Status' => 'active'
        ]);
        $admin->assignRole([$adminRole->id]);

        // --- Create Regular User ---
        $user = User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('12345678'),
            'roles_name' => ["user"], // optional
            'Status' => 'active'
        ]);
        $user->assignRole([$userRole->id]);
    }
}
