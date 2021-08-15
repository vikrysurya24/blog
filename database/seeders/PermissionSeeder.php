<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $authorities = config('permission.authorities');

        $listPermissions = [];
        $superAdminPermissions = [];
        $adminPermissions = [];
        $authorPermissions = [];

        foreach ($authorities as $key => $permissions) {
            foreach ($permissions as $permission) {
                $listPermissions[] = [
                    'name' => $permission,
                    'guard_name' => 'web',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                // Super Admin
                $superAdminPermissions[] = $permission;

                // Admin
                if (in_array($key, ['manage_posts', 'manage_categories', 'manage_tags'])) {
                    $adminPermissions[] = $permission;
                }
                // Author
                if (in_array($key, ['manage_posts'])) {
                    $authorPermissions[] = $permission;
                }
            }
        }

        // Insert Permission
        Permission::insert($listPermissions);

        // Insert Roles
        // SuperAdmin
        $superAdmin = Role::create([
            'name' => 'Super Admin',
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        // Admin
        $admin = Role::create([
            'name' => 'Admin',
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        // Author
        $author = Role::create([
            'name' => 'Author',
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Give Permission
        $superAdmin->givePermissionTo($superAdminPermissions);
        $admin->givePermissionTo($adminPermissions);
        $author->givePermissionTo($authorPermissions);

        $userSuperAdmin = User::find(1)->assignRole('Super Admin');
    }
}
