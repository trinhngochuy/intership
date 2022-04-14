<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('role_permissions')->truncate();
        DB::table('role_permissions')->insert([
            [
                'role_id' => '1',
                'permission_id'=>'1',
            ],
            [
                'role_id' => '1',
                'permission_id'=>'2',
            ],
            [
                'role_id' => '1',
                'permission_id'=>'3',
            ],
            [
                'role_id' => '1',
                'permission_id'=>'4',
            ],
            [
                'role_id' => '2',
                'permission_id'=>'1',
            ],
            [
                'role_id' => '2',
                'permission_id'=>'2',
            ],
            [
                'role_id' => '2',
                'permission_id'=>'3',
            ],
            [
                'role_id' => '2',
                'permission_id'=>'5',
            ],
            [
                'role_id' => '2',
                'permission_id'=>'6',
            ],
            [
                'role_id' => '2',
                'permission_id'=>'7',
            ],
            [
                'role_id' => '2',
                'permission_id'=>'8',
            ],
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
