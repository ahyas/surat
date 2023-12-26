<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index');
Auth::routes();
    
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/admin', 'AdminController@index')->name('admin')->middleware('admin');
    Route::get('/admin/user', 'Admin\UserController@index')->name('admin.user')->middleware('admin');
    Route::post('/admin/user/save','Admin\UserController@save')->name('admin.user.save')->middleware('admin');
    Route::get('/admin/user/{id_user}/delete','Admin\UserController@delete')->name('admin.user.delete')->middleware('admin');
    Route::get('/admin/user/{id_user}/edit','Admin\UserController@edit')->name('admin.user.edit')->middleware('admin');
    Route::post('/admin/user/{id_user}/update','Admin\UserController@update')->name('admin.user.update')->middleware('admin');

    Route::get('/admin/referensi/klasifikasi_surat', 'Admin\KlasifikasiSuratController@index')->name('admin.referensi.klasifikasi_surat')->middleware('admin');
    Route::get('/admin/referensi/bidang', 'Admin\BidangController@index')->name('admin.referensi.bidang')->middleware('admin');

    Route::get('/staff', 'Staff\StaffController@index')->name('staff')->middleware('staff');

    Route::get('/operator', 'OperatorController@index')->name('operator')->middleware('operator');
    Route::get('/operator/user', 'OperatorController@user')->name('operator.user')->middleware('operator');

    Route::get('/api/user','Admin\UserController@getUser')->name('api.user');
    Route::get('/api/bidang','Admin\BidangController@getBidang')->name('api.bidang');

Auth::routes();
