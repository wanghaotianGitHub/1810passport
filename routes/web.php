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
Route::get('/', function () {
    return view('welcome');
});
Route::get('index','Port\PortController@index');

Route::get('reg','Port\LoginController@reg'); //注册

Route::post('regdo','Port\LoginController@regdo'); //注册执行

Route::get('login','Port\LoginController@login'); //登录

//Route::any('logindo','Port\LoginController@logindo'); //登录执行

Route::any('doLogin','App\AppController@doLogin'); // 登录执行

Route::get('appid','Port\LoginController@appid')->middleware('AdminMiddleware');

Route::get('weather','Port\LoginController@weather'); //天气

Route::get('weatherdo','Port\LoginController@weatherdo'); //天气

Route::get('show','Port\LoginController@show'); //天气

Route::any('doLoginApi','App\AppController@doLoginApi');