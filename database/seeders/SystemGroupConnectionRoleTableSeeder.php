<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SystemGroupConnectionRoleTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('system_group_connection_role')->delete();

        \DB::table('system_group_connection_role')->insert([
            0 => [
                'system_role_code' => 'admin',
                'system_group_code' => 'aplikasi',
            ],
            1 => [
                'system_role_code' => 'admin',
                'system_group_code' => 'laporan',
            ],
            2 => [
                'system_role_code' => 'admin',
                'system_group_code' => 'setting',
            ],
        ]);

    }
}
