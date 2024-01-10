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

Route::get('/', function(){
    return redirect()->route('login');
});
Auth::routes();
    Route::get('home', 'HomeController@index')->name('home');
//login sebagai super admin
    Route::group(['middleware'=>'role: 1'], function(){
        //BEGIN::user list
        Route::get('/user/list', 'Users\UserController@index')->name('user.list.index');
        Route::get('/user/list/get_data','Users\UserController@getUser')->name('user.list.get_data');
        Route::post('/user/list/save','Users\UserController@save')->name('user.list.save');
        Route::get('/user/list/{id_user}/edit','Users\UserController@edit')->name('user.list.edit');
        Route::post('/user/list/{id_user}/update','Users\UserController@update')->name('user.list.update');
        Route::get('/user/list/{id_user}/delete','Users\UserController@delete')->name('user.list.delete');
        //END::user list

        //BEGIN::user roles
        Route::get('/user/roles', 'Users\RoleController@index')->name('user.role.index');
        Route::get('/user/roles/get_data','Users\RoleController@getRole')->name('user.role.get_data');
        //END::user roles

        //BEGIN::user permissions
        Route::get('/user/permissions', 'Users\PermissionController@index')->name('user.permission.index');
        Route::get('/user/permissions/get_data','Users\PermissionController@getPermission')->name('user.permission.get_data');
        Route::get('/user/permissions/{id_user}/edit', 'Users\PermissionController@edit')->name('user.permission.edit');
        Route::post('/user/permissions/{id_user}/update','Users\PermissionController@update')->name('user.permission.update');
        //END::user permissions

        //BEGIN::Bidang
        Route::get('/referensi/bidang', 'Referensi\BidangController@index')->name('referensi.bidang.index'); 
        Route::get('/referensi/bidang/get_data','Referensi\BidangController@getBidang')->name('referensi.bidang.get_data');
        //END::Bidang
    });
//login sebagai super admin dan admin tata usaha
    Route::group(['middleware'=>'role: 1, 6'], function(){
         //BEGIN::klasifikasi surat
         Route::get('/referensi/klasifikasi_surat', 'Referensi\KlasifikasiSuratController@index')->name('referensi.klasifikasi_surat.index');
         Route::get('/referensi/klasifikasi_surat/get_data','Referensi\KlasifikasiSuratController@getKlasifikasi')->name('referensi.klasifikasi_surat.get_data');
         Route::post('/referensi/klasifikasi_surat/save', 'Referensi\KlasifikasiSuratController@save')->name('referensi.klasifikasi_surat.save');
         Route::get('/referensi/klasifikasi_surat/{id_klasifikasi}/edit', 'Referensi\KlasifikasiSuratController@edit')->name('referensi.klasifikasi_surat.edit');
         Route::post('/referensi/klasifikasi_surat/{id_klasifikasi}/update', 'Referensi\KlasifikasiSuratController@update')->name('referensi.klasifikasi_surat.update');
         Route::get('/referensi/klasifikasi_surat/{id_klasifikasi}/delete', 'Referensi\KlasifikasiSuratController@delete')->name('referensi.klasifikasi_surat.delete');
         //END::klasifikasi surat

         //BEGIN::fungsi surat
        Route::get('/referensi/fungsi_surat/{id_ref_klasifikasi}/detail', 'Referensi\FungsiSuratController@detailFungsiSurat');
        Route::get('/referensi/fungsi_surat/save', 'Referensi\FungsiSuratController@save')->name('referensi.fungsi_surat.save');
        Route::get('/referensi/fungsi_surat/{id_fungsi}/edit', 'Referensi\FungsiSuratController@edit')->name('referensi.fungsi_surat.edit');
        Route::get('/referensi/fungsi_surat/{id_fungsi}/update', 'Referensi\FungsiSuratController@update')->name('referensi.fungsi_surat.update');
        Route::get('/referensi/fungsi_surat/{id_fungsi}/delete', 'Referensi\FungsiSuratController@delete')->name('referensi.fungsi_surat.delete');
        //END::end fungsi surat

        //BEGIN::kegiatan surat
        Route::get('/referensi/kegiatan_surat/{id_ref_fungsi}/detail', 'Referensi\KegiatanSuratController@detailKegiatanSurat');
        Route::post('/referensi/kegiatan_surat/save', 'Referensi\KegiatanSuratController@save')->name('referensi.kegiatan_surat.save');
        Route::get('/referensi/kegiatan_surat/{id_kegiatan}/edit', 'Referensi\KegiatanSuratController@edit')->name('referensi.kegiatan_surat.edit');
        Route::get('/referensi/kegiatan_surat/{id_kegiatan}/update', 'Referensi\KegiatanSuratController@update')->name('referensi.kegiatan_surat.update');
        Route::get('/referensi/kegiatan_surat/{id_kegiatan}/delete', 'Referensi\KegiatanSuratController@delete')->name('referensi.kegiatan_surat.delete');
        //END::kegiatan surat

        //START::transaksi surat
        Route::get('/referensi/transaksi_surat/{id_ref_kegiatan}/detail', 'Referensi\TransaksiSuratController@detailTransaksiSurat')->name('referensi.transaksi_surat.detail');
        Route::post('/referensi/transaksi_surat/save', 'Referensi\TransaksiSuratController@save')->name('referensi.transaksi_surat.save');
        Route::get('/referensi/transaksi_surat/{id_transaksi}/edit', 'Referensi\TransaksiSuratController@edit')->name('referensi.transaksi_surat.edit');
        Route::get('/referensi/transaksi_surat/{id_transaksi}/update', 'Referensi\TransaksiSuratController@update')->name('referensi.transaksi_surat.update');
        Route::get('/referensi/transaksi_surat/{id_transaksi}/delete', 'Referensi\TransaksiSuratController@delete')->name('referensi.transaksi_surat.delete');
        //END::transaksi surat
    });
   
    Route::group(['middleware'=>'role:5, 6, 101'], function(){
         //Begin::Transaksi surat masuk
        Route::get('/transaksi/surat_masuk', 'Transaksi\SuratMasuk\SuratMasukController@index')->name('transaksi.surat_masuk');
        Route::get('/transaksi/surat_masuk/get_data','Transaksi\SuratMasuk\SuratMasukController@getData')->name('transaksi.surat_masuk.get_data');
        Route::post('/transaksi/surat_masuk/save','Transaksi\SuratMasuk\SuratMasukController@save')->name('transaksi.surat_masuk.save');
        Route::get('/transaksi/surat_masuk/{id}/edit', 'Transaksi\SuratMasuk\SuratMasukController@edit')->name('transaksi.surat_masuk.edit');
        Route::post('/transaksi/surat_masuk/{id}/update', 'Transaksi\SuratMasuk\SuratMasukController@update')->name('transaksi.surat_masuk.update');
        Route::get('/transaksi/surat_masuk/{id}/delete', 'Transaksi\SuratMasuk\SuratMasukController@delete')->name('transaksi.surat_masuk.delete');
        //End::Transaksi surat masuk
    });
//login sebagai admin tata usaha
    Route::group(['middleware'=>'role:6, 101'], function(){
        Route::get('/transaksi/surat_keluar', 'Transaksi\SuratKeluar\SuratKeluarController@index')->name('transaksi.surat_keluar');
        Route::get('/transaksi/surat_keluar/get_data', 'Transaksi\SuratKeluar\SuratKeluarController@getData')->name('transaksi.surat_keluar.get_data');
        Route::post('/transaksi/surat_keluar/save', 'Transaksi\SuratKeluar\SuratKeluarController@save')->name('transaksi.surat_keluar.save');
        Route::get('/transaksi/surat_keluar/{id_surat}/edit', 'Transaksi\SuratKeluar\SuratKeluarController@edit')->name('transaksi.surat_keluar.edit');
        Route::post('/transaksi/surat_keluar/{id_surat}/update', 'Transaksi\SuratKeluar\SuratKeluarController@update')->name('transaksi.surat_keluar.update');
        Route::get('/transaksi/surat_keluar/{id_surat}/delete', 'Transaksi\SuratKeluar\SuratKeluarController@delete')->name('transaksi.surat_keluar.delete');

        Route::get('/referensi/{id_ref_klasifikasi}/get_fungsi_list', 'Transaksi\SuratKeluar\SuratKeluarController@getFungsiList')->name('transaksi.surat_keluar.get_fungsi_list');
        Route::get('/referensi/{id_ref_fungsi}/get_kegiatan_list', 'Transaksi\SuratKeluar\SuratKeluarController@getKegiatanList')->name('transaksi.surat_keluar.get_kegiatan_list');
        Route::get('/referensi/{id_ref_kegiatan}/get_transaksi_list', 'Transaksi\SuratKeluar\SuratKeluarController@getTransaksiList')->name('transaksi.surat_keluar.get_transaksi_list');

    });
    
    
Auth::routes();
