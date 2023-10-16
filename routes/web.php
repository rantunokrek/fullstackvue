<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;

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
Route::any('/{slug}', function () {
    return view('welcome');
});

Route::get('/test', 'TestController@test');
Route::post('app/create_tag', 'TagController@create_tag');
Route::post('app/edit_tag', 'TagController@edit_tag');
Route::post('app/delete_tag', 'TagController@delete_tag');
Route::get('app/get_tags', 'TagController@get_tag');
