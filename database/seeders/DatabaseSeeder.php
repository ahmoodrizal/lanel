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
        $managePromo = Permission::create(['name' => 'manage-promo'])->assignRole($roleManager);
        $manageLaundries = Permission::create(['name' => 'manage-laundries'])->assignRole($roleManager);

        // Create Dummy User
        $admin =  User::create([
            'name' => 'Admin',
            'username' => 'admin1994',
            'email' => 'admin1994@lanel.co.id',
            'password' => Hash::make('password'),
        ]);

        $manager =  User::create([
            'name' => 'John Doe',
            'username' => 'johndoe',
            'email' => 'johndoe@lanel.co.id',
            'password' => Hash::make('password'),
        ]);

        $customer =  User::create([
            'name' => 'mark',
            'username' => 'markzux',
            'email' => 'mark@lanel.co.id',
            'password' => Hash::make('password'),
        ]);

        // Asssign Role to User
        $admin->assignRole($roleAdmin);
        $manager->assignRole($roleManager);
        $customer->assignRole($roleCustomer);
    }
}
