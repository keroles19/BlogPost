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
        //
        \App\User::create([
            'name'=>'keroles',
            'email'=>'kero@gmail.com',
            'password'=>bcrypt('kero2020'),
            'profile_img'=>'profile_img1.jpg'
        ]);
    }
}
