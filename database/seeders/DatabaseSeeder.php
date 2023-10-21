<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Create Role
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleManager = Role::create(['name' => 'manager']);
        $roleCustomer = Role::create(['name' => 'customer']);

        // Create Permissions
        $manageUser = Permission::create(['name' => 'manage-user']);
        $manageShop = Permission::create(['name' => 'manage-shop'])->assignRole($roleManager);
        $managePromo = Permission::create(['name' => 'manage-promo']);

        // Create Dummy User
        $admin =  User::create([
            'name' => 'Kim Minju',
            'username' => 'minguri',
            'email' => 'minguri@izone.co.kr',
            'password' => Hash::make('melon123'),
        ]);

        $manager =  User::create([
            'name' => 'Kang Seulgi',
            'username' => 'ddeulgi',
            'email' => 'seulgi@rv.co.kr',
            'password' => Hash::make('melon123'),
        ]);

        $customer =  User::create([
            'name' => 'Kim Gaeul',
            'username' => 'gaeulsunbae',
            'email' => 'gaeul@ive.co.kr',
            'password' => Hash::make('melon123'),
        ]);

        User::factory(7)->create();

        // Asssign Role to User
        $admin->assignRole($roleAdmin);
        $manager->assignRole($roleManager);
        $customer->assignRole($roleCustomer);
    }
}
