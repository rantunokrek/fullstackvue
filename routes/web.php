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
Route::post('app/upload', 'TagController@uploadFile');
Route::post('app/delete_image', 'TagController@delete_image');

// category
Route::post('app/create_category', 'TagController@create_category');
Route::post('app/edit_category', 'TagController@edit_category');
Route::post('app/delete_category', 'TagController@delete_category');
Route::get('app/get_category', 'TagController@get_category');


Route::post('app/create_user', 'TagController@createUser');
Route::get('app/get_users', 'TagController@getUsers');
Route::post('app/edit_users', 'TagController@editUser');


//  roles routes

