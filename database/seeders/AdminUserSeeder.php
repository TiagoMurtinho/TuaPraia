<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {

        $role = Role::firstOrCreate(['name' => 'admin']);

        $permissions = ['view', 'create', 'edit', 'delete'];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $role->givePermissionTo($permissions);

        $adminUsers = [
            [
                'email' => 'tiago-admin@hotmail.com',
                'name' => 'Admin User-1',
                'password' => bcrypt('password1'),
            ],
            [
                'email' => 'joao-admin@hotmail.com',
                'name' => 'Admin User-2',
                'password' => bcrypt('password2'),
            ],
        ];

        foreach ($adminUsers as $adminUser) {
            User::firstOrCreate(
                ['email' => $adminUser['email']],
                [
                    'name' => $adminUser['name'],
                    'password' => $adminUser['password'],
                ]
            )->assignRole($role);
        }
    }
}
