<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Lucas',
            'password' => bcrypt('password'),
            'email' => 'Lucas@gmail.com',
            'phone' => '912345678',
            'photo' => 'Lucas_1610629296.jpg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            ]);
        
        DB::table('users')->insert([
            'name' => 'Marcelo',
            'password' => bcrypt('password'),
            'email' => 'marcelo@gmail.com',
            'phone' => '912345671',
            'photo' => 'Marcelo_1610629275.png',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            ]);
    }
}
