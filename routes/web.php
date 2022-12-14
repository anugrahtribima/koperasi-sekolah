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

Route::group(['prefix' => 'loans', 'namespace' => 'Loans'], function(){
    route::get('/', 'LoanController@index')->name('loans');
    route::get('cetak', 'LoanController@cetak')->name('loans.cetak');
    route::post('{loan}','LoanController@destroy')->name('loans.destroy');

    route::get('print/{loan}','PrintController@show')->name('loans.print');

    route::get('create/{type}',  'LoanController@create')->name('loans.create');
    route::post('kalkulasi/{type}','LoanController@kalkulasi')->name('loans.kalkulasi');
    route::post('store/{type}','LoanController@store')->name('loans.store');

    route::get('submissions', 'SubmissionController@index')->name('submissions');
    route::post('submissions/{loan}','SubmissionController@store')->name('submissions.store');
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
    Route::post('/', 'UserController@store')->name('users.store');
    Route::get('create', 'UserController@create')->name('users.create');
    Route::get('{user}/edit', 'UserController@edit')->name('users.edit');
    Route::patch('{user}/update', 'UserController@update')->name('users.update');

    Route::get('pegawai','PegawaiController@index')->name('pegawai.index');
    Route::get('anggota','AnggotaController@index')->name('anggota.index');
});

Route::group(['prefix' =>'reports'],function(){
    Route::get('reports/savings', 'Report\ReportController@savings')->name('reports.savings');
    Route::get('reports/anggota', 'Report\LoanController@moon')->name('reports.loans');
    Route::get('reports/all/anggota', 'Report\LoanController@all')->name('reports.all.loans');
    Route::get('reports/all/transaksi', 'Report\TransaksiController@all')->name('reports.all.transaksi');
    Route::get('reports/moon/installments', 'Report\InstallmentController@moonthly')->name('reports.moon.installments');
    Route::get('reports/installments', 'Report\InstallmentController@all')->name('reports.installments');
});

Route::group(['prefix' => 'transaksi'], function(){
    route::get('', 'TransaksiController@index')->name('transaksi');
    route::get('edit/{saving}', 'TransaksiController@edit')->name('transaksi.edit');
    route::patch('store/{saving}', 'TransaksiController@store')->name('transaksi.store');

    route::get('cetak-butki/{penarikan}','KwitansiController@show')->name('transaksi.cetak-bukti');
});

Route::group(['prefix' => 'penarikan'], function(){
    route::get('','PenarikanController@index')->name('penarikan');
});