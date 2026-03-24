<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        $permissions = [
        'role-list',
        'role-create',
        'role-edit',
        'role-delete',
        'create-product',
        'view-all-products',
        'view-product-details',
        'update-product',
        'delete-product',
        'add-to-cart',
        'view-cart',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
    
}
