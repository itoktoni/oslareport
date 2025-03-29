<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SystemGroupConnectionMenuTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('system_group_connection_menu')->delete();

        \DB::table('system_group_connection_menu')->insert([
            0 => [
                'system_group_code' => 'setting',
                'system_menu_code' => 'link',
            ],
            1 => [
                'system_group_code' => 'setting',
                'system_menu_code' => 'menu',
            ],
            2 => [
                'system_group_code' => 'setting',
                'system_menu_code' => 'permission',
            ],
            3 => [
                'system_group_code' => 'setting',
                'system_menu_code' => 'roles',
            ],
            4 => [
                'system_group_code' => 'setting',
                'system_menu_code' => 'setting',
            ],
            5 => [
                'system_group_code' => 'setting',
                'system_menu_code' => 'user',
            ],
            6 => [
                'system_group_code' => 'setting',
                'system_menu_code' => 'groups',
            ],
            7 => [
                'system_group_code' => 'laporan',
                'system_menu_code' => 'report_user',
            ],
        ]);

    }
}
