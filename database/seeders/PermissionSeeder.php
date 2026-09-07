<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Seed the "Super Admin" permission role (full access to every admin
     * panel section). This mirrors the permission the project's own admin
     * account (rabiulk449@gmail.com) actually uses.
     */
    public function run(): void
    {
        $permission = [
            'posts' => ['add' => 'on', 'delete' => 'on', 'all' => 'on', 'list' => 'on'],
            'postsOther' => ['category' => 'on', 'tags' => 'on', 'comments' => 'on'],
            'pages' => ['add' => 'on', 'delete' => 'on', 'all' => 'on', 'list' => 'on'],
            'medies' => ['add' => 'on', 'delete' => 'on', 'all' => 'on', 'list' => 'on'],
            'ecommerceSetting' => ['general' => 'on', 'coupons' => 'on'],
            'products' => ['add' => 'on', 'delete' => 'on', 'all' => 'on', 'list' => 'on'],
            'productsOther' => ['category' => 'on', 'tag' => 'on', 'attribute' => 'on'],
            'reports' => ['summery' => 'on', 'products' => 'on', 'customer' => 'on', 'orders' => 'on'],
            'clients' => ['add' => 'on', 'delete' => 'on', 'all' => 'on', 'list' => 'on'],
            'brands' => ['add' => 'on', 'delete' => 'on', 'all' => 'on', 'list' => 'on'],
            'sliders' => ['add' => 'on', 'delete' => 'on', 'all' => 'on', 'list' => 'on'],
            'galleries' => ['add' => 'on', 'delete' => 'on', 'all' => 'on', 'list' => 'on'],
            'menus' => ['add' => 'on', 'delete' => 'on', 'all' => 'on', 'list' => 'on'],
            'themeSetting' => ['list' => 'on'],
            'adminUsers' => ['add' => 'on', 'delete' => 'on', 'list' => 'on'],
            'adminRoles' => ['add' => 'on', 'delete' => 'on', 'all' => 'on', 'list' => 'on'],
            'users' => ['add' => 'on', 'update' => 'on', 'delete' => 'on', 'list' => 'on'],
            'subscribe' => ['delete' => 'on', 'list' => 'on'],
            'appsSetting' => ['general' => 'on', 'mail' => 'on', 'sms' => 'on', 'social' => 'on'],
        ];

        DB::table('permissions')->updateOrInsert(
            ['id' => 1],
            [
                'name' => 'administrator',
                'permission' => json_encode($permission),
                'status' => 'active',
                'addedby_id' => 1,
                'editedby_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
