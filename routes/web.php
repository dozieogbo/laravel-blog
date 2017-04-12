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

Route::get('/post/{id}', [
    'uses' => 'PostController@View',
    'as' => 'blog.post'
]);

Route::get('/like/{id}', [
    'uses' => 'PostController@Like',
    'as' => 'blog.like'
])->middleware('auth');

Route::get('/unlike/{id}', [
    'uses' => 'PostController@UnLike',
    'as' => 'blog.unlike'
])->middleware('auth');

Route::post('/comment/{id}', [
    'uses' => 'PostController@Comment',
    'as' => 'blog.comment'
]);

Route::get('/about', function () {
    return view('others.about');
})->name('others.about');

Route::get('/contact', function () {
    return view('others.contact');
})->name('others.contact');

Route::post('/contact', [
    'uses' => 'PostController@PostContact',
    'name' => 'others.contact'
]);

Route::group(['prefix' => 'admin', 'middleware' => 'auth.admin'], function () {
    Route::get('/', [
        'uses' => 'AdminController@Index',
        'as' => 'admin.index'
    ]);

    Route::get('/json', [
        'uses' => 'AdminController@getPostsJSON',
        'as' => 'admin.json'
    ]);

    Route::get('create', function () {
        return view('admin.create');
    })->name('admin.create');

    Route::get('view', [
        'uses' => 'AdminController@ViewAdmin',
        'as' => 'admin.view'
    ]);

    Route::get('create/admin', function () {
        return view('admin.add');
    })->name('admin.create.admin');

    Route::post('create/admin', [
        'uses' => 'AdminController@AddAdmin',
        'as' => 'admin.create.admin'
    ]);

    Route::get('edit/admin/{id}', [
        'uses'=> 'AdminController@EditAdmin',
        'as' => 'admin.edit.admin'
    ]);

    Route::get('delete/admin/{id}', [
        'uses'=> 'AdminController@DeleteAdmin',
        'as' => 'admin.delete.admin'
    ]);

    Route::post('edit/admin', [
        'uses'=> 'AdminController@UpdateAdmin',
        'as' => 'admin.update.admin'
    ]);

    Route::get('create', [
        'uses'=> 'AdminController@Create',
        'as' => 'admin.create'
    ]);

    Route::post('create', [
        'uses'=> 'AdminController@PostCreate',
        'as' => 'admin.create'
    ]);

    Route::get('edit/{id}', [
        'uses'=> 'AdminController@Edit',
        'as' => 'admin.edit'
    ]);

    Route::get('delete/{id}', [
        'uses'=> 'AdminController@Delete',
        'as' => 'admin.delete'
    ]);

    Route::post('edit', [
        'uses'=> 'AdminController@Update',
        'as' => 'admin.update'
    ]);
});

Auth::routes();

Route::get('/home', 'HomeController@index');
