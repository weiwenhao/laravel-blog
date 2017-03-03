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

//auth('admin')->logout();
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
Auth::routes();

/*
 * 后台登录注册路由,上线后注意注释掉注册路由
 */

Route::group(['prefix' => 'admin','namespace'=>'Admin'], function () {
    //登录方面路由
    Route::get('login','Auth\LoginController@showLoginForm');
    Route::post('login','Auth\LoginController@login');

    Route::get('register','Auth\RegisterController@showRegistrationForm');
    Route::post('register','Auth\RegisterController@register');

    Route::post('logout','Auth\LoginController@logout');
});

Route::group(['prefix' => 'admin','namespace'=>'Admin','middleware'=>['auth.admin']], function () {
    //后台框架
    Route::get('',function (){  //  /admin  -> 框架层
       return view('admin.layouts.ifarme'); //外层框架
    });
    //控制台
    Route::get('index',function (){  //第一个界面, dash,也就是面板页
        return view('admin.index');
    });
    //文章管理
    Route::get('/article/ajax_index','ArticleController@ajaxIndex');
    Route::resource('article', 'ArticleController');
    //标签管理
    Route::get('/key/ajax_key','KeyController@ajaxIndex');
    Route::resource('key', 'KeyController');
    //分类管理
    Route::get('/category/ajax_category','CategoryController@ajaxIndex');
    Route::resource('category', 'CategoryController');
    //评论管理
    Route::get('/comment/ajax_index','CommentController@ajaxIndex');
    Route::delete('/comment/{comment}','CommentController@destroy');
    Route::get('/comment',function (){ //显示主页
        return view('admin.comment.list');
    });
    //画布管理
    Route::resource('/img','ImgController');


});






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
//    dd(\App\Models\Article::all()->lists('id'));
//    dd(Auth::guest('admin')); //true ,没有登录返回true??
//    dd(Auth()->guest('admin')); //true ,没有登录返回true??
//        Auth::logout();
//    dd(\App\Models\Article::with('category')->get()[0]->category);
//    echo \App\Models\Article::find(1)->category->id;
//    dd(\App\Models\Article::find(1)->keys->toArray());
});

// [your site path]/Http/routes.php




