<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemMenuTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        DB::table('system_menu')->delete();

        DB::table('system_menu')->insert([
            [
                'system_menu_code' => 'roles',
                'system_menu_name' => 'Roles',
                'system_menu_url' => 'roles',
                'system_menu_controller' => 'App\\Http\\Controllers\\Core\\RolesController',
                'system_menu_action' => 'roles.getTable',
                'system_menu_type' => 1,
                'system_menu_sort' => 9,
                'system_menu_description' => null,
                'system_menu_enable' => null,
                'system_menu_can_delete' => 1,
            ],
            [
                'system_menu_code' => 'user',
                'system_menu_name' => 'User',
                'system_menu_url' => 'user',
                'system_menu_controller' => 'App\\Http\\Controllers\\Core\\UserController',
                'system_menu_action' => 'user.getTable',
                'system_menu_type' => 1,
                'system_menu_sort' => null,
                'system_menu_description' => '',
                'system_menu_enable' => null,
                'system_menu_can_delete' => 1,
            ],
            [
                'system_menu_code' => 'master',
                'system_menu_name' => 'Master',
                'system_menu_url' => 'master',
                'system_menu_controller' => null,
                'system_menu_action' => null,
                'system_menu_type' => 2,
                'system_menu_sort' => null,
                'system_menu_description' => null,
                'system_menu_enable' => null,
                'system_menu_can_delete' => 1,
            ],
            [
                'system_menu_code' => 'setting',
                'system_menu_name' => 'Setting Website',
                'system_menu_url' => 'pengaturan',
                'system_menu_controller' => 'App\\Http\\Controllers\\Core\\SettingController',
                'system_menu_action' => 'setting.getCreate',
                'system_menu_type' => 1,
                'system_menu_sort' => null,
                'system_menu_description' => '',
                'system_menu_enable' => null,
                'system_menu_can_delete' => 1,
            ],
            [
                'system_menu_code' => 'groups',
                'system_menu_name' => 'Group',
                'system_menu_url' => 'groups',
                'system_menu_controller' => 'App\\Http\\Controllers\\Core\\GroupsController',
                'system_menu_action' => 'groups.getTable',
                'system_menu_type' => 1,
                'system_menu_sort' => 10,
                'system_menu_description' => null,
                'system_menu_enable' => null,
                'system_menu_can_delete' => 1,
            ],
            [
                'system_menu_code' => 'menu',
                'system_menu_name' => 'Menu',
                'system_menu_url' => 'menu',
                'system_menu_controller' => 'App\\Http\\Controllers\\Core\\MenuController',
                'system_menu_action' => 'menu.getTable',
                'system_menu_type' => 1,
                'system_menu_sort' => 8,
                'system_menu_description' => '',
                'system_menu_enable' => null,
                'system_menu_can_delete' => 1,
            ],
            [
                'system_menu_code' => 'link',
                'system_menu_name' => 'Link',
                'system_menu_url' => 'link',
                'system_menu_controller' => 'App\\Http\\Controllers\\Core\\LinkController',
                'system_menu_action' => 'link.getTable',
                'system_menu_type' => 1,
                'system_menu_sort' => 7,
                'system_menu_description' => null,
                'system_menu_enable' => null,
                'system_menu_can_delete' => 1,
            ],
            [
                'system_menu_code' => 'permission',
                'system_menu_name' => 'Permission',
                'system_menu_url' => 'permission',
                'system_menu_controller' => 'App\\Http\\Controllers\\Core\\PermissionController',
                'system_menu_action' => 'permission.getTable',
                'system_menu_type' => 1,
                'system_menu_sort' => null,
                'system_menu_description' => null,
                'system_menu_enable' => null,
                'system_menu_can_delete' => 1,
            ],
            [
                'system_menu_code' => 'report_user',
                'system_menu_name' => 'Report User',
                'system_menu_url' => 'report_user',
                'system_menu_controller' => 'App\Http\Controllers\ReportUserController',
                'system_menu_action' => 'report_user.getCreate',
                'system_menu_type' => 1,
                'system_menu_sort' => null,
                'system_menu_description' => null,
                'system_menu_enable' => null,
                'system_menu_can_delete' => 1,
            ],
        ]);

    }
}
