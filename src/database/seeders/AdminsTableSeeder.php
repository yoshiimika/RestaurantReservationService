<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('name', 'admin')->first();
        User::create([
            'name' => '管理者',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role_id' => $adminRole->id,
        ]);

        $shopOwnerRole = Role::where('name', 'shop_owner')->first();
        User::create([
            'name' => '店舗管理者',
            'email' => 'shop@shop.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role_id' => $shopOwnerRole->id,
            'shop_id' => 1,
        ]);

        $userRole = Role::where('name', 'user')->first();
        User::create([
            'name' => 'Test',
            'email' => 'test@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role_id' => $userRole->id,
        ]);
    }
}
