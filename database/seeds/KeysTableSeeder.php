<?php

use App\Models\Key;
use Illuminate\Database\Seeder;

class KeysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Key::create([
            'name' => 'php',
        ]);

        Key::create([
            'name' => 'laravel',
        ]);
        Key::create([
            'name' => 'php框架',
        ]);
        Key::create([
            'name' => 'js基础',
        ]);
        Key::create([
            'name' => 'nginx',
        ]);
        Key::create([
            'name' => 'vue.js',
        ]);
        Key::create([
            'name' => 'thinkPHP',
        ]);
        Key::create([
            'name' => '二分查找',
        ]);
        Key::create([
            'name' => '单元测试',
        ]);

        //

    }
}
