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

Route::get('/villagerRecords', 'VillagerRecordsController@index')->name('villagerRecords.index');
Route::get('/getVillagerRecords', 'VillagerRecordsController@getVillagerRecords')->name('villagerRecords.getVillagerRecords');

Route::get('/villager/{id}', 'VillagerDetailController@index')->name('villagerDetail.index');
Route::get('/getVillagerDetail', 'VillagerDetailController@getVillagerDetail');
Route::post('/setVillagerDetail', 'VillagerDetailController@setVillagerDetail');
Route::post('/markLive', 'VillagerDetailController@markLive');
Route::post('/markDead', 'VillagerDetailController@markDead');
Route::post('/deleteVillager', 'VillagerDetailController@deleteVillager');

Route::get('/houseRecords', 'HouseRecordsController@index')->name('houseRecords.index');
Route::get('/getHouseRecords', 'HouseRecordsController@getHouseRecords')->name('houseRecords.getHouseRecords');

Route::get('/house/{id}', 'HouseDetailController@index')->name('houseDetail.index');
Route::get('/getHouseDetail', 'HouseDetailController@getHouseDetail');
Route::post('/setHouseDetail', 'HouseDetailController@setHouseDetail');
Route::post('/deleteHouse', 'HouseDetailController@deleteHouse');
Route::post('/addMember', 'HouseDetailController@addMember');

// statistics routes
Route::get('/statistics', 'StatisticsController@index')->name('statistics.index');
Route::get('/statistics/populationByGender', 'StatisticsController@populationByGender')->name('statistics.populationByGender');
Route::get('/statistics/populationByRace', 'StatisticsController@populationByRace')->name('statistics.populationByRace');
Route::get('/statistics/populationByAgeRange', 'StatisticsController@populationByAgeRange')->name('statistics.populationByAgeRange');
Route::get('/statistics/populationByEducationLevel', 'StatisticsController@populationByEducationLevel')->name('statistics.populationByEducationLevel');
Route::get('/statistics/populationByMaritalStatus', 'StatisticsController@populationByMaritalStatus')->name('statistics.populationByMaritalStatus');
Route::get('/statistics/monthlyHouseholdIncome', 'StatisticsController@monthlyHouseholdIncome')->name('statistics.monthlyHouseholdIncome');
Route::post('/statistics/birthRateByYear', 'StatisticsController@birthRateByYear');
Route::post('/statistics/birthRateByRangeOfYears', 'StatisticsController@birthRateByRangeOfYears');
Route::post('/statistics/deathRateByYear', 'StatisticsController@deathRateByYear');
Route::post('/statistics/deathRateByRangeOfYears', 'StatisticsController@deathRateByRangeOfYears');

//Dynamic pdf routes
Route::get('/dynamic_pdf', 'DynamicPDFController@index')->name('dynamic_pdf');
Route::get('/dynamic_pdf/pdf', 'DynamicPDFController@pdf');
