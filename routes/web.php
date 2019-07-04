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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/courses', 'CoursesController@index')->name('courses');
Route::get('/course/{slug}', 'CourseController@index')->name('course');

Route::group(['middleware' => 'auth'], function () {
    Route::get('admin', 'Admin\AdminIndexController@index');


    //---------------------------------------------------------courses

    Route::get('admin/courses', 'Admin\AdminCoursesController@index')->name('admin.courses');

    Route::get('admin/add-course', 'Admin\AdminCoursesController@create_form');

    Route::post('admin/add-course', 'Admin\AdminCoursesController@create')->name('admin.create-course');

    Route::get('admin/edit-course/{slug?}', 'Admin\AdminCoursesController@edit')->name('admin.edit-course');

    Route::post('admin/edit-course/{slug?}', 'Admin\AdminCoursesController@update')->name('admin.update-course');

    Route::post('admin/edit-course-delete-img/{slug}', 'Admin\AdminCoursesController@deleteImg')->name('admin.deleteImg');


    Route::get('admin/edit-course/{slug?}/delete', 'Admin\AdminCoursesController@delete')->name('admin.delete-course');

    // course request

    Route::get('admin/course-request/{slug}', 'CourseRequestController@index')->name('course-request');


});
