<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Category::create([
           'name' => 'PHP',
        ]);
        Category::create([
            'name' => 'JAVA SCRIPT',
        ]);
        Category::create([
            'name' => '算法初步',
        ]);
        Category::create([
            'name' => '心情随笔',
        ]);




    }
}
