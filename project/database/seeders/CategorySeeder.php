<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('categories')->truncate();
        DB::table('categories')->insert([  
            [
                'id' => '1',
               'name'=>'Sport',
               'parent_id'=>0,
               'offset'=>0,
                'created_at' => '2000-01-01',
                'updated_at' => '2000-01-01',
            ], 
            [
                'id' => '2',
               'name'=>'FoodBall',
               'parent_id'=>1,
               'offset'=>1,
                'created_at' => '2000-01-01',
                'updated_at' => '2000-01-01',
            ], 
            [
                'id' => '3',
               'name'=>'Basketball',
               'parent_id'=>1,
               'offset'=>1,
                'created_at' => '2000-01-01',
                'updated_at' => '2000-01-01',
            ], 
            [
                'id' => '4',
               'name'=>'Manchester United',
               'parent_id'=>2,
               'offset'=>2,
                'created_at' => '2000-01-01',
                'updated_at' => '2000-01-01',
            ], 
         ]);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
