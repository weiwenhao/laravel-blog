<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/comment','CommentController@getCommentList');
Route::post('/comment','CommentController@storyComment');



Route::get('captcha-test', function()
{
    $form = '<form method="post" action="captcha-test">';
    $form .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
//    $form .= '<p>' . captcha_img() . '</p>';
    $form .= '<img src="/captcha" />';
    $form .= '<p><input type="text" name="captcha"></p>';
    $form .= '<p><button type="submit" name="check">Check</button></p>';
    $form .= '</form>';
    return $form;
});

Route::post('captcha-test',function (){
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
});

