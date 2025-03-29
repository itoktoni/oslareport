<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SystemGroupTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('system_group')->delete();

        \DB::table('system_group')->insert([
            0 => [
                'system_group_code' => 'aplikasi',
                'system_group_name' => 'Aplikasi',
                'system_group_sort' => 2,
                'system_group_enable' => 1,
                'system_group_url' => null,
                'system_group_icon' => 'window-sidebar',
                'system_group_description' => null,
            ],
            1 => [
                'system_group_code' => 'laporan',
                'system_group_name' => 'Laporan',
                'system_group_sort' => 1,
                'system_group_enable' => 1,
                'system_group_url' => null,
                'system_group_icon' => 'printer',
                'system_group_description' => null,
            ],
            2 => [
                'system_group_code' => 'master',
                'system_group_name' => 'Master',
                'system_group_sort' => 7,
                'system_group_enable' => 1,
                'system_group_url' => null,
                'system_group_icon' => 'database',
                'system_group_description' => null,
            ],
            3 => [
                'system_group_code' => 'setting',
                'system_group_name' => 'System',
                'system_group_sort' => -1,
                'system_group_enable' => 1,
                'system_group_url' => null,
                'system_group_icon' => 'wrench-adjustable-circle',
                'system_group_description' => null,
            ],
        ]);

    }
}
