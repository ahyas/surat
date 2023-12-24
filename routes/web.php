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



Auth::routes();
    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/admin', 'AdminController@index')->name('admin')->middleware('admin');
    Route::get('/admin/user', 'Admin\UserController@index')->name('admin.user')->middleware('admin');
    Route::get('/admin/klasifikasi_surat', 'Admin\KlasifikasiSuratController@index')->name('admin.klasifikasi_surat')->middleware('admin');

    Route::get('/operator', 'OperatorController@index')->name('operator')->middleware('operator');
    Route::get('/operator/user', 'OperatorController@user')->name('operator.user')->middleware('operator');

Auth::routes();
