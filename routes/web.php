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

Auth::routes();

Route::get('/', 'PostsController@index')->name('posts.index');
Route::get('/blog/{post}', 'PostsController@show')->name('posts.show');

Route::middleware('auth')->group(function () {
    Route::post('/blog/{post}/comments', 'PostCommentsController@store')->name('posts.comments.store');

    Route::prefix('admin')->group(function () {
        Route::get('/', function () {
            return redirect()->route('admin.posts.index');
        });

        Route::get('/posts', 'Admin\PostsController@index')->name('admin.posts.index');
        Route::get('/posts/create', 'Admin\PostsController@create')->name('admin.posts.create');
        Route::post('/posts', 'Admin\PostsController@store')->name('admin.posts.store');
        Route::get('/posts/{post}/edit', 'Admin\PostsController@edit')->name('admin.posts.edit');
        Route::patch('/posts/{post}', 'Admin\PostsController@update')->name('admin.posts.update');
        Route::delete('/posts/{post}', 'Admin\PostsController@destroy')->name('admin.posts.destroy');

        Route::get('/comments', 'Admin\CommentsController@index')->name('admin.comments.index');
        Route::delete('/comments/{comment}', 'Admin\CommentsController@destroy')->name('admin.comments.destroy');
    });
});


