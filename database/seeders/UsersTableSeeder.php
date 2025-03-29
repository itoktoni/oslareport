<?php

namespace Database\Seeders;

use App\Dao\Models\Core\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        DB::table('users')->insert([
            'id' => 0,
            'name' => 'Admin',
            'username' => 'admin',
            'phone' => null,
            'email' => 'admin@gmail.com',
            'email_verified_at' => '2022-12-13 18:51:38',
            'password' => Hash::make('admin'), // password
            'role' => 'admin',
            'level' => 100,
            'active' => 1,
            'remember_token' => null,
            'created_at' => null,
            'updated_at' => '2023-02-25 10:54:19',
        ]);

        User::factory(500)->create();
    }
}
