<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    const ADMIN_ROLE_ID = 1;
    const EDITOR_ROLE_ID = 2;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define our array of Role and Permission assignments
        $roles_and_permissions = [
            'roles' => [
                'admin',
                'editor',
            ],
            'permissions' => [
                [
                    'role_ids' => [self::ADMIN_ROLE_ID, self::EDITOR_ROLE_ID],
                    'name' => 'approve comments',
                ],
                [
                    'role_ids' => [self::ADMIN_ROLE_ID, self::EDITOR_ROLE_ID],
                    'name' => 'view comments',
                ],
                [
                    'role_ids' => [self::ADMIN_ROLE_ID, self::EDITOR_ROLE_ID],
                    'name' => 'view users',
                ],
	            [
		            'role_ids' => [self::ADMIN_ROLE_ID],
		            'name' => 'create users',
	            ],
                [
                    'role_ids' => [self::ADMIN_ROLE_ID],
                    'name' => 'delete users',
                ],
                [
                    'role_ids' => [self::ADMIN_ROLE_ID],
                    'name' => 'edit users',
                ],
	            [
		            'role_ids' => [self::ADMIN_ROLE_ID],
		            'name' => 'create tokens',
	            ],
	            [
		            'role_ids' => [self::ADMIN_ROLE_ID],
		            'name' => 'delete tokens',
	            ],
            ],
        ];

        // Create the necessary Roles
        foreach ($roles_and_permissions['roles'] as $role) {
            Role::create(['name' => $role]);
        }

        // Create the necessary Permissions
        foreach ($roles_and_permissions['permissions'] as $permission) {
            Permission::create(['name' => $permission['name']]);
        }

        /*
         * If a Permission is assigned to a Role in the array,
         * grant that Role the necessary Permission
         */
        $roles = Role::all();
        foreach ($roles as $role) {
            foreach ($roles_and_permissions['permissions'] as $permission) {
                if (in_array($role->id, $permission['role_ids'])) {
                    $role->givePermissionTo($permission['name']);
                }
            }
        }
    }
}
