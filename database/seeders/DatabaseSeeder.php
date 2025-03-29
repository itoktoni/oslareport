<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SystemGroupTableSeeder::class);
        $this->call(SystemMenuTableSeeder::class);
        $this->call(SystemRoleTableSeeder::class);
        $this->call(SystemGroupConnectionMenuTableSeeder::class);
        $this->call(SystemGroupConnectionRoleTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
