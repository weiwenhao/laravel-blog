<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(\App\Models\Article::class,30)->create()->each(function($u) {
//            $u->posts()->save(factory(App\Post::class)->make());
            $keys_length = \App\Models\Key::all(['id'])->count();
            $sync = [];
            for($i=0;$i<3;$i++){//$sync中有3个数
                $sync[] = mt_rand(1,$keys_length);
            }
            //去重
            $sync = array_unique($sync);
            $u->keys()->sync($sync);
        });
    }
}
