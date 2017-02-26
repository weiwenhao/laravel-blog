<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Input;

Route::get('/', function () {
//    return view('welcome');
    return redirect('/article');
});

/*
 * 前台界面
 */
Route::group(['middleware' => 'web'], function () {
    Route::get('/article','ArticleController@index');
    Route::get('/article/{id}','ArticleController@show');
});

/*
 * 用户注册
 */
    Auth::routes();



/**
 * 数据测试
 */
Route::get('/test',function (Faker\Generator $faker,\App\Repositories\ArticleRepository $article){
//   return str_random(1);   //一个随机数
//    return mt_rand(1,10);
//    $text = implode("\n\n", $faker->paragraphs(mt_rand(3, 6)));
//   return str_limit($text,100); //sdlfjlsdjfdsjf .....
//    dd($faker->dateTimeBetween('-1 month','+ 3 days'));
//    return $faker->randomElement([1,4,3]); // 1,3,4其中的一个
//    $cat = \App\Models\Category::find(3);
//    dd($cat->articles);
//    dd(url()->previous());
//    $articel = \App\Models\Article::find(1);
//    dd(\App\Models\Key::all()->count()); //9
//    dd(\App\Models\Article::find(1));
    dd(\App\Models\Article::all()->lists('id'));
});

// [your site path]/Http/routes.php

Route::any('captcha-test', function()
{
    if (Request::getMethod() == 'POST')
    {
        $rules = ['captcha' => 'required|captcha'];
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails())
        {
            echo '<p style="color: #ff0000;">Incorrect!</p>';
        }
        else
        {
            echo '<p style="color: #00ff30;">Matched :)</p>';
        }
    }

    $form = '<form method="post" action="captcha-test">';
    $form .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
    $form .= '<p>' . captcha_img() . '</p>';
    $form .= '<p><input type="text" name="captcha"></p>';
    $form .= '<p><button type="submit" name="check">Check</button></p>';
    $form .= '</form>';
    return $form;
});



