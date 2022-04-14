<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('roles')->truncate();
        DB::table('roles')->insert([  
            [
                'id' => '1',
               'role_name'=>'User',      
            ], 
            [
                'id' => '2',
               'role_name'=>'Admin',
            ], 
         ]);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
