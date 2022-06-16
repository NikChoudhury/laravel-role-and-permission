<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Module;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::truncate();
        Module::truncate();

        //Post
        $post_module = Module::create([
            'name' => 'post',
        ]);
        
        Permission::insert([
            [
                'module_id' => $post_module->id,
                'key' => 'view_post',
                'name' => 'View',
            ], 
            [
                'module_id' => $post_module->id,
                'key' => 'create_post',
                'name' => 'Create',
            ], 
            [
                'module_id' => $post_module->id,
                'key' => 'edit_post',
                'name' => 'Edit',
            ],
            [
                'module_id' => $post_module->id,
                'key' => 'delete_post',
                'name' => 'Delete',
            ],
        ]);


        //roles
        $roles_module=Module::Create([
            'name'=>'roles'
        ]);

        Permission::insert(
        [
            [
                'module_id'=>$roles_module['id'],
                'key'=>'view_role',
                'name'=>'View'
            ],
            [
                'module_id'=>$roles_module['id'],
                'key'=>'create_role',
                'name'=>'Create'
            ],
            [
                'module_id'=>$roles_module['id'],
                'key'=>'edit_role',
                'name'=>'Edit'
            ],
            [
                'module_id'=>$roles_module['id'],
                'key'=>'delete_role',
                'name'=>'Delete'
            ],
        ]
        );

        //roles
        $users_module=Module::Create([
            'name'=>'users'
        ]);

        Permission::insert(
        [
            [
                'module_id'=>$users_module['id'],
                'key'=>'view_user',
                'name'=>'View'
            ],
            [
                'module_id'=>$users_module['id'],
                'key'=>'create_user',
                'name'=>'Create'
            ],
            [
                'module_id'=>$users_module['id'],
                'key'=>'edit_user',
                'name'=>'Edit'
            ],
            [
                'module_id'=>$users_module['id'],
                'key'=>'delete_user',
                'name'=>'Delete'
            ],
        ]
        );
    }
}
