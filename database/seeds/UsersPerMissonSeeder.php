<?php

use Corp\Permission;
use Corp\Role;
use Illuminate\Database\Seeder;

class UsersPerMissonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
	  Permission::firstOrNew(['name' => 'VIEW_ADMIN']);
	  Permission::firstOrNew(['name' => 'ADD_POSTS']);
	  Permission::firstOrNew(['name' => 'UPDATE_POSTS']);
	  Permission::firstOrNew(['name' => 'DELETE_POSTS']);
	  Permission::firstOrNew(['name' => 'ADMIN_USERS']);
	  Permission::firstOrNew(['name' => 'VIEW_ADMIN_POSTS']);
	  Permission::firstOrNew(['name' => 'EDIT_USERS']);
	  Permission::firstOrNew(['name' => 'VIEW_ADMIN_MENU']);
	  Permission::firstOrNew(['name' => 'EDIT_MENU']);
	  Permission::firstOrNew(['name' => 'MEDIAS.CREATE']);
	  Permission::firstOrNew(['name' => 'MEDIAS.UPDATE']);
	  Permission::firstOrNew(['name' => 'MEDIAS.DELETE']);
	  Permission::firstOrNew(['name' => 'REGENERATE_THUMBNAILS_ADMIN']);

	  Role::firstOrNew(['name' => 'Admin']);
	  Role::firstOrNew(['name' => 'Moderator']);



	  $allPermission= Permission::all();

	  $allPermsIds = [];
	  foreach ($allPermission as $per){
		  $allPermsIds[] = $per->id;
	  }


	  Role::where('id',1)->perms()->sync(
		  $allPermsIds

	  );





    }
}
