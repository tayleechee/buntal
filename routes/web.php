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

/*Route::get('/', function () {
    return view('welcome');
})->name('welcome');*/

Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/chart','HomeController@chart');

Route::get('/fillForm/step1', function() {
	return view('fillForm.step1');
})->name('fillForm.step1');

Route::get('/fillForm/step2', function() {
	return view('fillForm.step2');
});

Route::get('/fillForm/success', function() {
	return view('fillForm.success');
});

Route::get('/test', function() {
	return view('test');
});

Route::post('/fillForm/processStep1', 'FillFormController@processStep1');

Route::post('/fillForm/processStep2', 'FillFormController@processStep2');
