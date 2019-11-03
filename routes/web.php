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

Auth::routes();


Route::get('/posts', 'PostsController@index')->name('posts');
Route::get('/post/{slug}', 'PostController@index')->name('post');
Route::get('/author/{userid}', 'AuthorController@index')->name('author');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard/postrequests', 'Dashboard\PostRequest\IndexController@index')->name('dashboard.post-requests');
    Route::get('/dashboard', 'Dashboard\PostRequest\IndexController@index')->name('dashboard.index');


    //Route::get('/home', 'Dashboard\Posts\indexController@index')->name('home');
    //Route::get('/dashboard/home', 'Dashboard\HomeController@index')->name('home');

    Route::get('/dashboard/messages/{request_id}', 'Dashboard\Courserequest\MessagesController@messages')->name('dashboard.messages');


    //---------------------------------------------------------posts

    Route::get('/dashboard/posts', 'Dashboard\Posts\IndexController@index')->name('dashboard.posts');

    Route::get('/dashboard/add-post', 'Dashboard\Posts\IndexController@create_form');

    Route::post('/dashboard/add-post', 'Dashboard\Posts\IndexController@create')->name('dashboard.create-post');

    Route::get('/dashboard/edit-post/{slug?}', 'Dashboard\Posts\IndexController@edit')->name('dashboard.edit-post');

    Route::post('/dashboard/edit-post/{slug?}', 'Dashboard\Posts\IndexController@update')->name('dashboard.update-post');

    Route::post('/dashboard/edit-post-delete-img/{slug}', 'Dashboard\Posts\IndexController@deleteImg')->name('dashboard.deleteImg');


    Route::get('/dashboard/edit-post/{slug?}/delete', 'Dashboard\Posts\IndexController@delete')->name('dashboard.delete-post');

    // post request

//    Route::get('/dashboard/post-request/{slug}', 'Dashboard\CourseRequest\CreateRequestController@index')->name('dashboard.post-request');
//
//    Route::post('/dashboard/post-request-message/{request_id}', 'Dashboard\CourseRequest\SendMessageController@index')->name('post-request-message');
//
//    Route::post('/dashboard/start-training/{request_id}', 'Dashboard\CourseRequest\StartTrainingController@index')->name('start-training');
//    Route::post('/dashboard/close-request/{request_id}', 'Dashboard\CourseRequest\CloseRequestController@index')->name('close-request');

    //reviews
    Route::get('/dashboard/post-review-message/{request_id}', 'Dashboard\Posts\ReviewController@index')->name('dashboard.post-review');

    Route::post('/dashboard/post-review-message/{request_id}', 'Dashboard\Posts\ReviewController@addReview')->name('dashboard.add-review');


});
