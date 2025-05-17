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
Route::get('/document', Document::class)->name('document');
Auth::routes();
    Route::get("/test","TestController@index");
    //cek atentikasi surat keluar berdasarkan QR Code
    Route::get('/transaksi/surat_keluar/{id_surat}/verify', 'Transaksi\SuratKeluar\SuratKeluarController@verify')->name('transaksi.surat_keluar.verify');

    Route::group(['middleware'=>'role:1, 5, 6, 8, 10, 13, 16, 17, 18, 101'], function(){
        Route::get('home', 'HomeController@index')->name('home');
    });
    
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

        //BEGIN::level user
        Route::get('/user/level', 'Users\LevelUserController@index')->name('user.level.index');
        Route::get('/user/level/get_data', 'Users\LevelUserController@getData')->name('user.level.get_data');
        Route::post('/user/level/save', 'Users\LevelUserController@save')->name('user.level.save');
        Route::get('/user/{id_parent_user}/{id_sub_user}/delete', 'Users\LevelUserController@delete');
        //END::level user

        //BEGIN::Bidang
        Route::get('/referensi/bidang', 'Referensi\BidangController@index')->name('referensi.bidang.index'); 
        Route::get('/referensi/bidang/get_data','Referensi\BidangController@getBidang')->name('referensi.bidang.get_data');
        //END::Bidang

        Route::get('/referensi/jabatan','Referensi\JabatanController@index')->name('referensi.jabatan.index');
        Route::get('/referensi/jabatan/get_data','Referensi\JabatanController@getData')->name('referensi.jabatan.get_data');
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

        //Begin::register surat masuk
        Route::get('/register/surat_masuk', 'RegisterSuratMasukController@index')->name('register.surat_masuk'); 
        Route::get('/register/surat_masuk/{tahun}/{bulan}/get_data', 'RegisterSuratMasukController@getData')->name('register.get_data');
        Route::post('/register/surat_masuk/print', 'RegisterSuratMasukController@print')->name('register.print'); 
        //End::register surat masuk

        //Begin::register surat keluar
        Route::get('/register/surat_keluar', 'RegisterSuratKeluarController@index')->name('register.surat_keluar'); 
        Route::get('/register/surat_keluar/{tahun}/{bulan}/get_data', 'RegisterSuratKeluarController@getData');
        Route::post('/register/surat_keluar/print', 'RegisterSuratKeluarController@print')->name('register.surat_keluar.print'); 
        //End::register surat keluar

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
   
    Route::group(['middleware'=>'role:5, 6, 8, 10, 13, 16, 17, 18, 101'], function(){
         //Begin::Transaksi surat masuk
        Route::get('/transaksi/surat_masuk', 'Transaksi\SuratMasuk\SuratMasukController@index')->name('transaksi.surat_masuk');
        Route::get('/transaksi/surat_masuk/get_data','Transaksi\SuratMasuk\SuratMasukController@getData')->name('transaksi.surat_masuk.get_data');
        Route::post('/transaksi/surat_masuk/save','Transaksi\SuratMasuk\SuratMasukController@save')->name('transaksi.surat_masuk.save');
        Route::get('/transaksi/surat_masuk/{id}/edit', 'Transaksi\SuratMasuk\SuratMasukController@edit')->name('transaksi.surat_masuk.edit');
        Route::post('/transaksi/surat_masuk/{id}/update', 'Transaksi\SuratMasuk\SuratMasukController@update')->name('transaksi.surat_masuk.update');
        Route::get('/transaksi/surat_masuk/{id}/delete', 'Transaksi\SuratMasuk\SuratMasukController@delete')->name('transaksi.surat_masuk.delete');
        Route::get('/transaksi/surat_masuk/{id}/detail', 'Transaksi\SuratMasuk\SuratMasukController@detail')->name('transaksi.surat_masuk.detail');

        Route::get('/transaksi/surat_masuk/{id}/get_last_penerima', 'Transaksi\SuratMasuk\SuratMasukController@getLastPenerima');
        //End::Transaksi surat masuk

        //Begin::disposisi
        Route::get('/transaksi/surat_masuk/disposisi/{id}/daftar_disposisi', 'Transaksi\SuratMasuk\SuratMasukController@daftarDisposisi');
        Route::post('/transaksi/surat_masuk/disposisi/kirim', 'Transaksi\SuratMasuk\SuratMasukController@kirim')->name('transaksi.surat_masuk.disposisi.kirim');
        Route::get('/transaksi/surat_masuk/disposisi/{id}/lembar_disposisi/print', 'Transaksi\SuratMasuk\SuratMasukController@printDisposisi');
        //End::Disposisi

        //Begin::teruskan
        Route::post('/transaksi/surat_masuk/teruskan','Transaksi\SuratMasuk\SuratMasukController@teruskan')->name('transaksi.surat_masuk.teruskan.kirim');
        Route::post('/transaksi/surat_masuk/naikan','Transaksi\SuratMasuk\SuratMasukController@naikan')->name('transaksi.surat_masuk.naikan.kirim');
        //End::teruskan

        //Begin::tindak lanjut
        Route::post('/transaksi/surat_masuk/tindak_lanjut','Transaksi\SuratMasuk\SuratMasukController@tindakLanjut')->name('transaksi.surat_masuk.tindak_lanjut');
        //End::tindak lanjut
        Route::get('/arsip', 'Arsip\ArsipSuratAll@index')->name('arsip.semua_surat.index');
        Route::get('/arsip/get_data', 'Arsip\ArsipSuratAll@getData')->name('arsip.semua_surat.get_data');
        Route::get('/arsip/surat_masuk', 'Arsip\ArsipSuratMasukController@index')->name('arsip.surat_masuk.index');
        Route::get('/arsip/surat_masuk/get_data','Arsip\ArsipSuratMasukController@getData')->name('arsip.surat_masuk.get_data');
        Route::get('/arsip/surat_keluar','Arsip\ArsipsuratKeluarController@index')->name('arsip.surat_keluar.index');
        Route::get('/arsip/surat_keluar/get_data','Arsip\ArsipsuratKeluarController@getData')->name('arsip.surat_keluar.get_data');

    });

    Route::group(['middleware'=>'role:6, 8, 10, 13, 101'], function(){
        Route::get('/transaksi/surat_keluar', 'Transaksi\SuratKeluar\SuratKeluarController@index')->name('transaksi.surat_keluar');
        Route::get('/transaksi/surat_keluar/get_data', 'Transaksi\SuratKeluar\SuratKeluarController@getData')->name('transaksi.surat_keluar.get_data');
        Route::post('/transaksi/surat_keluar/save', 'Transaksi\SuratKeluar\SuratKeluarController@save')->name('transaksi.surat_keluar.save');
        Route::get('/transaksi/surat_keluar/{id_surat}/edit', 'Transaksi\SuratKeluar\SuratKeluarController@edit')->name('transaksi.surat_keluar.edit');
        Route::post('/transaksi/surat_keluar/{id_surat}/update', 'Transaksi\SuratKeluar\SuratKeluarController@update')->name('transaksi.surat_keluar.update');
        Route::get('/transaksi/surat_keluar/{id_surat}/delete', 'Transaksi\SuratKeluar\SuratKeluarController@delete')->name('transaksi.surat_keluar.delete');

        Route::get('/transaksi/surat_keluar/esign/index', 'Transaksi\SuratKeluar\EsignController@index')->name('transaksi.surat_keluar.index');
        Route::post('/transaksi/surat_keluar/esign/save', 'Transaksi\SuratKeluar\EsignController@saveEsign')->name('transaksi.surat_keluar.esign');
        
        //menambah daftar penerima surat keluar
        Route::get('/transaksi/surat_keluar/detail/add','Transaksi\SuratKeluar\SuratKeluarController@addDetail');
        //menghapus penerima surat keluar
        Route::get('/transaksi/surat_keluar/detail/{id_surat_keluar}/{id_penerima}/delete','Transaksi\SuratKeluar\SuratKeluarController@deleteDetail');
        //menampilkan daftar penerima pada surat keluar
        Route::get('/transaksi/surat_keluar/{id_surat_keluar}/detail','Transaksi\SuratKeluar\SuratKeluarController@getDetailSurat');
        Route::get('/transaksi/surat_keluar/{id_surat_keluar}/detail_eksternal','Transaksi\SuratKeluar\SuratKeluarController@getDetailSuratEksternal');
        Route::post('/transaksi/surat_keluar/{id_surat_keluar}/detail_eksternal/update','Transaksi\SuratKeluar\SuratKeluarController@updateDetailSuratEksternal');

        Route::get('/transaksi/surat_keluar/{id}/arsipkan', 'Transaksi\SuratKeluar\SuratKeluarController@arsipkan');

        Route::get('/referensi/{id_ref_klasifikasi}/get_fungsi_list', 'Transaksi\SuratKeluar\SuratKeluarController@getFungsiList')->name('transaksi.surat_keluar.get_fungsi_list');
        Route::get('/referensi/{id_ref_fungsi}/get_kegiatan_list', 'Transaksi\SuratKeluar\SuratKeluarController@getKegiatanList')->name('transaksi.surat_keluar.get_kegiatan_list');
        Route::get('/referensi/{id_ref_kegiatan}/get_transaksi_list', 'Transaksi\SuratKeluar\SuratKeluarController@getTransaksiList')->name('transaksi.surat_keluar.get_transaksi_list');

        Route::get("/template/surat_keluar", "Template\SuratKeluar\TemplateSuratKeluarController@index")->name("template.surat_keluar");
        Route::get("/template/surat_keluar/get_data", "Template\SuratKeluar\TemplateSuratKeluarController@getData")->name("template.surat_keluar.get_data");
        Route::get("/template/surat_keluar/count", "Template\SuratKeluar\TemplateSuratKeluarController@count")->name("template.surat_keluar.count");
        Route::post("/template/surat_keluar/save", "Template\SuratKeluar\TemplateSuratKeluarController@save")->name("template.surat_keluar.save");
        Route::get("/template/surat_keluar/{id}/detail", "Template\SuratKeluar\TemplateSuratKeluarController@detailSurat")->name("template.surat_keluar.detail_surat");
        Route::get("/template/surat_keluar/{id}/edit", "Template\SuratKeluar\TemplateSuratKeluarController@editSurat")->name("template.surat_keluar.edit_surat");
        Route::post("/template/surat_keluar/{id}/update", "Template\SuratKeluar\TemplateSuratKeluarController@updateSurat")->name("template.surat_keluar.update_surat");
        Route::get("/template/surat_keluar/{id}/delete", "Template\SuratKeluar\TemplateSuratKeluarController@deleteSurat")->name("template.surat_keluar.delete_surat");

        Route::get("/template/surat_keluar/{id}/get_menimbang","Template\SuratKeluar\TemplateSuratKeluarController@getMenimbang");
        Route::post("/template/surat_keluar/{id}/menimbang/save","Template\SuratKeluar\TemplateSuratKeluarController@saveMenimbang");
        Route::get("/template/surat_keluar/{id}/menimbang/edit","Template\SuratKeluar\TemplateSuratKeluarController@editMenimbang");
        Route::post("/template/surat_keluar/{id}/menimbang/update","Template\SuratKeluar\TemplateSuratKeluarController@updateMenimbang");
        Route::get("/template/surat_keluar/{id}/menimbang/delete","Template\SuratKeluar\TemplateSuratKeluarController@deleteMenimbang");
        
        Route::get("/template/surat_keluar/{id}/get_mengingat","Template\SuratKeluar\TemplateSuratKeluarController@getMengingat");
        Route::post("/template/surat_keluar/{id}/mengingat/save","Template\SuratKeluar\TemplateSuratKeluarController@saveMengingat");
        Route::get("/template/surat_keluar/{id}/mengingat/edit","Template\SuratKeluar\TemplateSuratKeluarController@editMengingat");
        Route::post("/template/surat_keluar/{id}/mengingat/update","Template\SuratKeluar\TemplateSuratKeluarController@updateMengingat");
        Route::get("/template/surat_keluar/{id}/mengingat/delete","Template\SuratKeluar\TemplateSuratKeluarController@deleteMengingat");
        
        Route::get("/template/surat_keluar/{id}/get_menetapkan","Template\SuratKeluar\TemplateSuratKeluarController@getMenetapkan");
        Route::post("/template/surat_keluar/{id}/menetapkan/save","Template\SuratKeluar\TemplateSuratKeluarController@saveMenetapkan");
        Route::get("/template/surat_keluar/{id}/menetapkan/edit","Template\SuratKeluar\TemplateSuratKeluarController@editMenetapkan");
        Route::post("/template/surat_keluar/{id}/menetapkan/update","Template\SuratKeluar\TemplateSuratKeluarController@updateMenetapkan");
        Route::get("/template/surat_keluar/{id}/menetapkan/delete","Template\SuratKeluar\TemplateSuratKeluarController@deleteMenetapkan");

        Route::get("/template/surat_keluar/{id}/nominatif","Template\SuratKeluar\TemplateSuratKeluarController@getNominatif");
        Route::post("/template/surat_keluar/{id}/nominatif/save","Template\SuratKeluar\TemplateSuratKeluarController@saveNominatif");
        Route::get("/template/surat_keluar/{id_surat_keluar}/{id_user}/nominatif/delete","Template\SuratKeluar\TemplateSuratKeluarController@deleteNominatif");
        Route::get("/template/surat_keluar/{id_surat_keluar}/{id_user}/nominatif/edit","Template\SuratKeluar\TemplateSuratKeluarController@editNominatif");
        Route::post("/template/surat_keluar/{id_surat_keluar}/{id_user}/nominatif/update","Template\SuratKeluar\TemplateSuratKeluarController@updateNominatif");
    });

    Route::group(['middleware'=>'role:5, 6,8,10, 13, 16, 17, 18, 101'], function(){
        Route::get('/transaksi/surat_keluar', 'Transaksi\SuratKeluar\SuratKeluarController@index')->name('transaksi.surat_keluar');
        Route::get('/transaksi/surat_keluar/get_data', 'Transaksi\SuratKeluar\SuratKeluarController@getData')->name('transaksi.surat_keluar.get_data');
        Route::get('/transaksi/surat_keluar/{id_surat_keluar}/detail_eksternal','Transaksi\SuratKeluar\SuratKeluarController@getDetailSuratEksternal');
        Route::get('/transaksi/surat_keluar/{id_surat_keluar}/detail','Transaksi\SuratKeluar\SuratKeluarController@getDetailSurat');
        Route::get('/transaksi/surat_keluar/esign/index', 'Transaksi\SuratKeluar\EsignController@index')->name('transaksi.surat_keluar.esign.index');
        Route::get('/transaksi/surat_keluar/esign/get_data', 'Transaksi\SuratKeluar\EsignController@getData')->name('transaksi.surat_keluar.esign.get_data');
        Route::post('/transaksi/surat_keluar/esign/otorisasi', 'Transaksi\SuratKeluar\EsignController@otorisasi')->name('transaksi.surat_keluar.esign.otorisasi');
    });
    
Auth::routes();
