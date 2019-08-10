<?php

namespace LucasQuinnGuru\SitetronicUser\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SeedRolesAndPermissionsCommand extends Command {

    protected $signature = 'lucas-quinn-guru:user-roles-and-permissions';

    protected $description = 'Run this command to seed roles and permissions and assign user_id(1) Super Admin role';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {

        $user = null;

        //Uncomment this out if you want to first user to have all the roles
        $user = User::find(1);

        if( $user == null ) {
            echo "No primary user found." . PHP_EOL;
        }

        $path = __DIR__ . '/../../database/seeder_models/roles-and-permissions.json';
        $perms = json_decode(file_get_contents( $path ), true);

        foreach ($perms as $permsKey => $permsVal) {
            //There should always be a super admin role and permission
            echo $permsVal[ 'name' ] . PHP_EOL;

            $role = Role::firstOrNew( ["name"=>$permsVal[ 'name' ] ]  );
            $role->name = $permsVal[ 'name' ];

            foreach ($permsVal[ 'permissions' ] as $permissionKey => $permissionVal) {

                $permissionName = $permissionVal[ 'name' ];

                echo "\t" . $permissionName . PHP_EOL;

                $permission = Permission::firstOrNew( ["name"=>$permissionName] );
                $permission->name = $permissionName;

                $permission->save();
                $role->givePermissionTo($permission);

                foreach( $permsVal[ 'roles' ] as $rolesKey=>$rolesVal ) {

                    echo "\tSub Role Name: " . $rolesVal[ 'name' ] . PHP_EOL;
                    $subRole = Role::firstOrNew( [ "name"=>$rolesVal[ 'name' ] ]  );
                    $subRole->name = $rolesVal[ 'name' ];

                    foreach( $rolesVal[ 'permissions' ] as $rolePermissionKey=>$rolePermissionVal ) {
                        $rolePermissionName = $rolePermissionVal[ 'name' ];

                        echo "\t\tPermission: " . $rolePermissionName . PHP_EOL;

                        $rolePermission = Permission::firstOrNew( ["name"=>$rolePermissionName] );
                        $rolePermission->name = $rolePermissionName;

                        $rolePermission->save();
                        $subRole->givePermissionTo($rolePermission);
                    }

                    $subRole->save();

                    if( $user != null ) {
                        $user->assignRole($subRole);
                    }
                }
            }

            $role->save();

            if( $user != null ) {
                $user->assignRole($role);
            }
        }
    }

}
