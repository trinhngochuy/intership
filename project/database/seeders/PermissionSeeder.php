<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('permissions')->truncate();
        DB::table('permissions')->insert([
            [
                'id' => '1',
                'code'=>'create-post',
            ],
            [
                'id' => '2',
                'code'=>'update-post',
            ],
            [
                'id' => '3',
                'code'=>'delete-post',
            ],
            [
                'id' => '4',
                'code'=>'list-post',
            ],
            [
                'id' => '5',
                'code'=>'list-post-admin',
            ],
            [
                'id' => '6',
                'code'=>'create-user',
            ],
            [
                'id' => '7',
                'code'=>'update-user',
            ],
            [
                'id' => '8',
                'code'=>'delete-user',
            ],
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
