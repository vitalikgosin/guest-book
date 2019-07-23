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

Route::get('/home', 'Admin\HomeController@index')->name('home');
Route::get('/courses', 'CoursesController@index')->name('courses');
Route::get('/course/{slug}', 'CourseController@index')->name('course');

Route::group(['middleware' => 'auth'], function () {
    Route::get('admin', 'Admin\AdminIndexController@index');


    Route::get('admin/home', 'Admin\HomeController@index')->name('home');
    Route::get('admin/messages/{request_id}', 'Admin\MessagesController@messages')->name('messages');
    //---------------------------------------------------------courses

    Route::get('admin/courses', 'Admin\AdminCoursesController@index')->name('admin.courses');

    Route::get('admin/add-course', 'Admin\AdminCoursesController@create_form');

    Route::post('admin/add-course', 'Admin\AdminCoursesController@create')->name('admin.create-course');

    Route::get('admin/edit-course/{slug?}', 'Admin\AdminCoursesController@edit')->name('admin.edit-course');

    Route::post('admin/edit-course/{slug?}', 'Admin\AdminCoursesController@update')->name('admin.update-course');

    Route::post('admin/edit-course-delete-img/{slug}', 'Admin\AdminCoursesController@deleteImg')->name('admin.deleteImg');


    Route::get('admin/edit-course/{slug?}/delete', 'Admin\AdminCoursesController@delete')->name('admin.delete-course');

    // course request

    Route::get('admin/course-request/{id}', 'Admin\CourseRequestController@index')->name('course-request');

    Route::post('admin/course-request-message/{request_id}', 'Admin\CourseRequestMessageController@index')->name('course-request-message');

    Route::post('admin/start-training/{request_id}', 'Admin\StartTrainingController@index')->name('start-training');
    Route::post('admin/close-request/{request_id}', 'Admin\CloseRequestController@index')->name('close-request');

    //reviews
    Route::get('admin/course-review-message/{request_id}', 'Admin\ReviewController@index')->name('admin.course-review');

    Route::post('admin/course-review-message/{request_id}', 'Admin\ReviewController@addReview')->name('admin.add-review');


});
