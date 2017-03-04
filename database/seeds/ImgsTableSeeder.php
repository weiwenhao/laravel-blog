<?php

use Illuminate\Database\Seeder;

class ImgsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Img::class,30)->create();
        //
    }
}
