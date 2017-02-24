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
           'cat_name' => 'PHP',
            'cat_desc' => '框架和基础知识的教学'
        ]);
        Category::create([
            'cat_name' => 'JAVA SCRIPT',
            'cat_desc' => '前段框架的学习'
        ]);
        Category::create([
            'cat_name' => '算法初步',
            'cat_desc' => '对《算法第4版的学习和感悟》'
        ]);
        Category::create([
            'cat_name' => '心情随笔',
            'cat_desc' => '则一事，终一生。'
        ]);




    }
}
