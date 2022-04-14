<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('role_users')->truncate();
        DB::table('role_users')->insert([
            [
                'role_id' => '2',
                'user_id'=>'1',
            ],
            [
                'role_id' => '1',
                'user_id'=>'2',
            ],
            [
                'role_id' => '1',
                'user_id'=>'3',
            ],
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
