<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('users')->truncate();
        DB::table('users')->insert([
            [
                'id' => '1',
                'first_name' => 'John',
                'last_name'=> 'Wich',
                'user_name'=> 'TestDemo',
                'thumbnail' => "https://i.pinimg.com/236x/70/0e/2d/700e2d692a9ad445874ab23578ef535a.jpg",
                'email' =>'demo@gmail.com',
                'password' => bcrypt('huy123'),
                'status'=>1,
                'birth_day' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => '2',
                'first_name' => 'Huy',
                'last_name'=> 'trinh',
                'user_name'=> 'gankplank',
                'thumbnail' => "https://i.pinimg.com/236x/ff/ed/af/ffedaf2068f7c0b382510aa2eff74162.jpg",
                'email' =>'user@gmail.com',
                'password' => bcrypt('huy123'),
                'status'=>1,
                'birth_day' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => '3',
                'first_name' => 'Ai đó',
                'last_name'=> 'Tên Huy',
                'user_name'=> 'gankplank09',
                'thumbnail' => "https://i.pinimg.com/236x/95/a5/ac/95a5ac42eef1401f3bf490cd266a1354.jpg",
                'email' =>'user@gmail.com',
                'password' => bcrypt('huy123'),
                'status'=>0,
                'birth_day' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
       DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
