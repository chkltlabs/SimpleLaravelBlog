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



Route::get('/', 'PostController@index');
Route::get('/all', 'PostController@index');
Route::get('/user/{id}', 'PostController@all');


Route::resource('posts', 'PostController');
Auth::routes();
/**
 *
Results of calling php artisan route:list inside the homestead-7 vm
+--------+-----------+------------------------+------------------+------------------------------------------------------------------------+--------------+
| Domain | Method    | URI                    | Name             | Action                                                                 | Middleware   |
+--------+-----------+------------------------+------------------+------------------------------------------------------------------------+--------------+
|        | GET|HEAD  | /                      |                  | App\Http\Controllers\PostController@index                              | web          |
|        | GET|HEAD  | all                    |                  | App\Http\Controllers\PostController@index                              | web          |
|        | GET|HEAD  | api/user               |                  | Closure                                                                | api,auth:api |
|        | GET|HEAD  | db                     |                  | Closure                                                                | web          |
|        | GET|HEAD  | home                   | home             | App\Http\Controllers\HomeController@index                              | web,auth     |
|        | GET|HEAD  | login                  | login            | App\Http\Controllers\Auth\LoginController@showLoginForm                | web,guest    |
|        | POST      | login                  |                  | App\Http\Controllers\Auth\LoginController@login                        | web,guest    |
|        | POST      | logout                 | logout           | App\Http\Controllers\Auth\LoginController@logout                       | web          |
|        | POST      | password/email         | password.email   | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail  | web,guest    |
|        | GET|HEAD  | password/reset         | password.request | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm | web,guest    |
|        | POST      | password/reset         | password.update  | App\Http\Controllers\Auth\ResetPasswordController@reset                | web,guest    |
|        | GET|HEAD  | password/reset/{token} | password.reset   | App\Http\Controllers\Auth\ResetPasswordController@showResetForm        | web,guest    |
|        | POST      | posts                  | posts.store      | App\Http\Controllers\PostController@store                              | web          |
|        | GET|HEAD  | posts                  | posts.index      | App\Http\Controllers\PostController@index                              | web          |
|        | GET|HEAD  | posts/create           | posts.create     | App\Http\Controllers\PostController@create                             | web          |
|        | GET|HEAD  | posts/{post}           | posts.show       | App\Http\Controllers\PostController@show                               | web          |
|        | PUT|PATCH | posts/{post}           | posts.update     | App\Http\Controllers\PostController@update                             | web          |
|        | DELETE    | posts/{post}           | posts.destroy    | App\Http\Controllers\PostController@destroy                            | web          |
|        | GET|HEAD  | posts/{post}/edit      | posts.edit       | App\Http\Controllers\PostController@edit                               | web          |
|        | GET|HEAD  | register               | register         | App\Http\Controllers\Auth\RegisterController@showRegistrationForm      | web,guest    |
|        | POST      | register               |                  | App\Http\Controllers\Auth\RegisterController@register                  | web,guest    |
+--------+-----------+------------------------+------------------+------------------------------------------------------------------------+--------------+



 */


