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
Route::get('/test', function () {
	return 'yada...';
});

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm');
// Route::post('register', 'Auth\RegisterController@create');

Route::group(['middleware' => 'auth'], function(){
	Route::resource('/', 'HomeController');
	
	// Guru
	Route::get('guru/grid', 'GuruController@grid');
	Route::resource('guru', 'GuruController');
	Route::get('guru/print/{id}', 'GuruController@print');

	// Cabang Dinas
	Route::post('cabdin/verifikasi', 'CabdinController@verifikasi');
	Route::post('cabdin/grid', 'CabdinController@grid');
	Route::resource('cabdin', 'CabdinController');

	// Sekretariat
	Route::get('sekretariat/print/{id}', 'SekretariatController@print');
	Route::post('sekretariat/set-penilai', 'SekretariatController@setPenilai');
	Route::post('sekretariat/grid', 'SekretariatController@grid');
	Route::resource('sekretariat', 'SekretariatController');

	// Penilai
	Route::get('penilai/nilai/{id}', 'PenilaiController@formNilai');
	Route::get('penilai/show-form-tolak/{id}', 'PenilaiController@showFormTolak');
	Route::get('penilai/print/{id}', 'PenilaiController@print');	
	Route::post('penilai/proses-tolak', 'PenilaiController@prosesTolak');
	Route::post('penilai/proses-terima', 'PenilaiController@prosesTerima');
	Route::post('penilai/grid', 'PenilaiController@grid');
	Route::resource('penilai', 'PenilaiController');	

	// Project
	Route::post('project/grid', 'ProjectController@grid');
	Route::resource('project', 'ProjectController');
	Route::get('project/print/{id}', 'ProjectController@print');
	Route::post('project/store', 'ProjectController@store');

	// Tester
	Route::post('testcase/grid', 'TestcaseController@grid');
	Route::resource('testcase', 'TestcaseController');
	Route::get('testcase/print/{id}', 'TestcaseController@print');
	Route::post('testcase/store', 'TestcaseController@store');
	//Route::post('testcase/update', 'TestcaseController@process');
	Route::post('testcase/update', 'TestcaseController@update');
	Route::get('testcase/edit/{id}', 'TestcaseController@edit');
	Route::get('testcase/process/{id}', 'TestcaseController@process');
	Route::get('testcase/{id}', 'TestcaseController@show');
	Route::get('testcase/view/{id}', 'TestcaseController@view');

});

// ajax option
Route::group(['prefix' => 'ajax/option', 'namespace' => 'Ajax'], function(){
	Route::post('unit-kerja', 'OptionController@unitKerja');
	Route::post('angka-kredit', 'OptionController@angkaKredit');
});

// ajax info
Route::group(['prefix' => 'ajax/info', 'namespace' => 'Ajax'], function(){
	Route::post('unit-kerja', 'InfoController@unitKerja');
	Route::post('angka-kredit', 'InfoController@angkaKredit');
});

// ajax option
/*Route::group(['prefix' => 'ajax/option', 'namespace' => 'Ajax'], function(){
	Route::post('project-id', 'ProjectController@projectId');
});*/
