<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Seed the project's default super admin account.
     * Depends on PermissionSeeder (permission_id 1) having run first.
     */
    public function run(): void
    {
        DB::table('users')->updateOrInsert(
            ['id' => 1],
            [
                'permission_id' => 1,
                'email' => 'rabiulk449@gmail.com',
                'name' => 'Rabiul Karim Islam',
                'mobile' => '01743988622',
                'profile' => null,
                'address_line1' => 'House Road sdf',
                'address_line2' => null,
                'postal_address' => null,
                'postal_code' => '1230',
                'city' => 476,
                'district' => 74,
                'division' => 14,
                'country' => null,
                'dob' => null,
                'gender' => 'Male',
                'status' => 1,
                'fetured' => 0,
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'password_show' => '123456789',
                'remember_token' => null,
                'api_token' => null,
                'device_key' => null,
                'verify_code' => null,
                'verify_code_status' => 0,
                'designation' => null,
                'balance' => 0,
                'subscriber' => 0,
                'customer' => 1,
                'business' => 0,
                'employee' => 0,
                'admin' => 1,
                'addedby_id' => 1,
                'addedby_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
