<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Admin::create([
            'name' => 'wei',
            'email' => '123@123.com',
            'password' => bcrypt('123456'),
            'remember_token' => str_random(10),
        ]);
        //
    }
}
