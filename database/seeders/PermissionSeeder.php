<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $permissions = [
            ['name' => 'view_users'],
            ['name' => 'edit_users'],
            ['name' => 'delete_users'],
            ['name' => 'create_users'],
            ['name' => 'view_products'],
            ['name' => 'edit_products'],
            ['name' => 'delete_products'],
            ['name' => 'create_products'],
            ['name' => 'view_categories'],
            ['name' => 'edit_categories'],
            ['name' => 'delete_categories'],
            ['name' => 'create_categories'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
