<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{

    public function run(): void
    {

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'update-settings',

            'view-list-user',
            'view-user',
            'create-user',
            'update-user',
            'destroy-user',

            'view-list-role',
            'view-role',
            'create-role',
            'update-role',
            'destroy-role',

            'view-list-permission',
            'view-permission',
            'create-permission',
            'update-permission',
            'destroy-permission',

            'view-list-student',
            'view-student',
            'create-student',
            'update-student',
            'destroy-student',

            'view-list-teacher-list',
            'view-teacher',
            'create-teacher',
            'update-teacher',
            'destroy-teacher',

            'view-list-academic-year',
            'view-academic-year',
            'create-academic-year',
            'update-academic-year',
            'destroy-academic-year',

            'view-list-school-class',
            'view-school-class',
            'create-school-class',
            'update-school-class',
            'destroy-school-class',

            'view-list-student-class',
            'view-student-class',
            'create-student-class',
            'update-student-class',
            'destroy-student-class',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $admin = Role::create(['name' => 'super-admin']);
        $admin->syncPermissions($permissions);


        $user = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@email.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => Str::random(10),
        ]);


        $user->assignRole($admin);
        $user->syncPermissions($permissions);


    }
}
