<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SystemRoleTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('system_role')->delete();

        \DB::table('system_role')->insert([
            0 => [
                'system_role_code' => 'admin',
                'system_role_name' => 'Admin',
                'system_role_description' => 'ini buat seluruh system untuk mengatur',
                'system_role_level' => 100,
            ],
            1 => [
                'system_role_code' => 'user',
                'system_role_name' => 'User',
                'system_role_description' => 'pengguna',
                'system_role_level' => 1,
            ],
        ]);

    }
}
