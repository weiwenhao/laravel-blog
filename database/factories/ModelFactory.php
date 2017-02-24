<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/**
 * 文章数据填充
 */
$factory->define(\App\Models\Article::class, function (Faker\Generator $faker) {
    $title = $faker->sentence(mt_rand(3,6));
    $content = implode("\n\n",$faker->paragraphs(mt_rand(7,13)));
    $cat_ids = \App\Models\Category::all(['id'])->toArray();
    $cat_ids = array_column($cat_ids,'id');
    return [
        'title' => $title,
        'seo_title' => str_slug($title),
        'content' => $content,
        'description' => str_limit($content,200),
        'publish_at' => $faker->dateTimeBetween('-1 month','+ 3 days'),
        'cat_id' => $faker->randomElement($cat_ids),
    ];
});

$factory->define(App\Models\Comment::class, function (Faker\Generator $faker) {
    $article_lengths = \App\Models\Article::all()->count();
    return [
        'username' => $faker->email,
        'content' => $faker->text(mt_rand(200,500)),
        'article_id' => mt_rand(1,$article_lengths),
        'goodNum' => mt_rand(0,100)
    ];
});
