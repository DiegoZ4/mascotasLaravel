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

Route::group(['prefix' => 'admin'], function(){

	Route::resource('users', 'UsersController')->middleware('auth');
	Route::get('users/{id}/destroy', [
		'uses' => 'usersController@destroy',
		'as' => 'users.destroy'
	])->middleware('auth');

	Route::resource('categories', 'CategoriesController')->middleware('auth');
	Route::get('categories/{id}/destroy', [
		'uses' => 'categoriesController@destroy',
		'as' => 'categories.destroy'
	])->middleware('auth');

	Route::resource('tags', 'TagsController')->middleware('auth');
	Route::get('tags/{id}/destroy', [
		'uses' => 'TagsController@destroy',
		'as' => 'tags.destroy'
	])->middleware('auth');

	Route::resource('articles', 'ArticlesController')->middleware('auth');
	Route::get('articles/{id}/destroy', [
		'uses' => 'articlesController@destroy',
		'as' => 'articles.destroy'
	])->middleware('auth');

	Route::resource('pets', 'PetsController')->middleware('auth');
	Route::get('pets/{id}/destroy', [
		'uses' => 'petsController@destroy',
		'as' => 'pets.destroy'
	])->middleware('auth');

	Route::post('visits/{pet_id}/indexpet', 'VisitsController@storeApi');
	Route::put('visits/{pet_id}/{id}/indexpet', 'VisitsController@updateApi');
	Route::get('visits/{pet_id}', 'VisitsController@indexApi');
	Route::get('visits/{id}/show', 'VisitsController@show');
	Route::delete('visits/{id}', 'VisitsController@destroy');
});

/*
Auth::routes();
 */

Route::get('admin/auth/login', [
    'uses'  => 'Auth\LoginController@showLoginForm',
    'as'    => 'admin.auth.login'
]);

Route::post('admin/auth/login', [
    'uses'  => 'Auth\LoginController@login',
    'as'    => 'login'
]);

Route::get('admin/auth/logout', [
    'uses'  => 'Auth\LoginController@logout',
    'as'    => 'admin.auth.logout'
]);

Route::post('auth', 'UsersController@checkAuth');
Route::get('auth', 'UsersController@checkAuth');

Route::get('/home', 'HomeController@index')->name('home');
