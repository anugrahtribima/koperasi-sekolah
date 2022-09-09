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

use App\Http\Controllers\LoanController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\SubmissionController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

route::group(['prefix' => 'loans', 'namespace' => 'Loans'], function(){
    route::get('/', 'LoanController@index')->name('loans');

    route::get('create/{type}',  'LoanController@create')->name('loans.create');
    route::post('store/{type}','LoanController@store')->name('loans.store');
    route::post('{loan}', 'LoanController@destroy')->name('loans.destroy');
    route::post('kalkulasi/{type}','LoanController@kalkulasi')->name('loans.kalkulasi');
    
    route::get('submissions', 'SubmissionController@index')->name('submissions');
    route::post('submissions/{loan}', 'SubmissionController@store')->name('submissions.store');
});

route::group(['namespace' => 'Types'], function(){
    route::resource('types', 'TypeController');
});

Route::group(['prefix' =>'savings'],  function(){
    route::get('/anggota', 'Savings\SavingController@index')->name('savings.anggota');
    route::get('create', 'Savings\SavingController@create')->name('savings.create');
    route::post('store', 'Savings\SavingController@store')->name('savings.store');
    route::get('edit/{saving}', 'Savings\SavingController@edit')->name('savings.edit');
    route::patch('update/{saving}', 'Savings\SavingController@update')->name('savings.update');
});

Route::group(['prefix' => 'transaksi'], function(){
    route::get('', 'TransaksiController@index')->name('transaksi');
    route::get('edit/{saving}', 'TransaksiController@edit')->name('transaksi.edit');
    route::patch('store/{saving}', 'TransaksiController@store')->name('transaksi.store');

});

Route::group(['prefix'=> 'installments', 'namespace'=>'Installments'], function(){
    route::get('/', 'InstallmentController@index')->name('installments.index');
    route::get('/{loan}', 'InstallmentController@show')->name('installments.show');
    route::get('/{loan}/create', 'InstallmentController@create')->name('installments.create');

    route::post('/{loan}/store', 'InstallmentController@store')->name('installments.store');
    route::get('cetak', 'LoanController@cetak')->name('loans.cetak');
    route::get('print/{loan}','PrintController@show')->name('loans.print');
});

Route::group(['prefix' => 'users', 'namespace' => 'Users'], function(){
    Route::get('pegawai','PegawaiController@index')->name('pegawai.index');
    Route::get('create', 'UserController@create')->name('users.create');
    
    Route::get('anggota','AnggotaController@index')->name('anggota.index');
});

Route::group(['prefix' =>'reports'],function(){
    Route::get('reports/savings', 'Reports\ReportController@savings')->name('reports.savings');
    Route::get('reports/anggota', 'Report\AnggotaController@moon')->name('reports.anggota');
    Route::get('reports/all/anggota', 'Report\AnggotaController@all')->name('reports.all.anggota');
    Route::get('reports/moon/installments', 'Reports\InstallmentController@moonthly')->name('reports.moon.installments');
    Route::get('reports/installments', 'Reports\InstallmentController@all')->name('reports.installments');
});
