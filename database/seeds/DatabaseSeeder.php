<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('categories')->truncate();
            DB::table('articles')->truncate();
            DB::table('keys')->truncate();
            DB::table('comments')->truncate();
            DB::table('article_key')->truncate();

        // $this->call(UsersTableSeeder::class);
            $this->call(CategoryTableSeeder::class);
            $this->call(KeysTableSeeder::class);
            $this->call(ArticlesTableSeeder::class);
            $this->call(CommentTableSeeder::class);
    }
}
