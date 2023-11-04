<?php

use App\Http\Middleware\AdminCheck;
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
// Route::get('/', function () {
//     return view('welcome');
// });
// Route::any('/{slug}', function () {
//     return view('welcome');
// });


Route::get('/logout', 'TagController@logout');
Route::get('/', 'TagController@index');
Route::any('{slug}', 'TagController@index');


Route::prefix('app')->middleware([AdminCheck::class])->group(function(){
     Route::post('/create_tag', 'TagController@create_tag');
Route::post('/edit_tag', 'TagController@edit_tag');
Route::post('/delete_tag', 'TagController@delete_tag');
Route::get('/get_tags', 'TagController@get_tag');
Route::post('/upload', 'TagController@uploadFile');
Route::post('/delete_image', 'TagController@delete_image');
// category
Route::post('/create_category', 'TagController@create_category');
Route::post('/edit_category', 'TagController@edit_category');
Route::post('/delete_category', 'TagController@delete_category');
Route::get('/get_category', 'TagController@get_category');
//user
Route::post('/create_user', 'TagController@createUser');
Route::get('/get_users', 'TagController@getUsers');
Route::post('/edit_users', 'TagController@editUser');
// login
Route::post('/admin_login', 'TagController@admin_login');
//roles add
Route::post('/create_role', 'TagController@addRole');
Route::get('/get_roles', 'TagController@getRoles');
Route::post('/edit_role', 'TagController@editRole');
//Assign Roll
Route::post('/assign_roles', 'TagController@assignRoll');



});




//  roles routes

