<?php
use \Illuminate\Http\Request as Request;
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

Route::get('/', [
    'uses' => 'PostController@Index',
    'as' => 'blog.index'
]);

Route::get('/checkdb', [
    'uses' => 'PostController@CheckDB',
    'as' => 'blog.checkdb'
]);

Route::get('/post/{id}', [
    'uses' => 'PostController@View',
    'as' => 'blog.post'
]);

Route::get('/about', function () {
    return view('others.about');
})->name('others.about');

Route::get('/contact', function () {
    return view('others.contact');
})->name('others.contact');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('admin.index');

    Route::get('create', function () {
        return view('admin.create');
    })->name('admin.create');

    Route::post('create', [
        'uses'=> 'AdminController@Create',
        'as' => 'admin.create'
    ]);

    Route::get('edit/{id}', [
        'uses'=> 'AdminController@Edit',
        'as' => 'admin.edit'
    ]);

    Route::post('edit', [
        'uses'=> 'AdminController@Update',
        'as' => 'admin.edit'
    ]);
});
