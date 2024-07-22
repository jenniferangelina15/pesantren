<?php

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index');
/*
Route::get('/user', 'UserController@index');
Route::get('/user-register', 'UserController@create');
Route::post('/user-register', 'UserController@store');

*/
Route::get('/user-edit/{id}', 'UserController@edit')->name('user.edit');

Route::resource('user', 'UserController');
Route::resource('santri', 'SantriController');
Route::get('/santri-10', 'SantriController@index10')->name('santri.index10');
Route::get('/santri-11', 'SantriController@index11')->name('santri.index11');
Route::get('/santri-12', 'SantriController@index12')->name('santri.index12');
Route::get('/santri-alumni', 'SantriController@indexAlumni')->name('santri.indexAlumni');
Route::get('/updateStatus', 'SantriController@updateStatus')->name('santri.updateStatus');
// Tambahkan route untuk update kelas santri
Route::get('/santri/updateKelas/{id}', 'SantriController@updateKelas')->name('santri.updateKelas');


Route::resource('loginWali', 'WaliController');
Route::post('/loginWali', 'WaliController@login')->name('wali.login');
Route::get('/dataBayar', 'WaliController@dataBayar')->name('wali.dataBayar');
Route::get('/bayar', 'WaliController@bayar')->name('wali.bayar');
Route::get('/logout', 'WaliController@logout')->name('wali.logout');

Route::resource('pembayaran', 'PembayaranController');
Route::post('/storeWali', 'PembayaranController@storeWali')->name('pembayaran.storeWali');
Route::get('/get-available-months', 'PembayaranController@getAvailableMonths');
Route::get('/pembayaran-belum', 'PembayaranController@indexBelum')->name('pembayaran.indexBelum');
Route::get('/pembayaran-telah', 'PembayaranController@indexTelah')->name('pembayaran.indexTelah');

Route::resource('kasmasuk', 'KasMasukController');
Route::resource('kaskeluar', 'KasKeluarController');

// routes/web.php
Route::get('/get-pembayaran-details', 'PembayaranController@getDetails');

Route::resource('pembayaran', 'PembayaranController');
Route::get('/laporan/pembayaran', 'LaporanController@pembayaran');
Route::get('/laporan/pembayaran/pdf', 'LaporanController@pembayaranPdf')->name('pembayaranPdf');
Route::get('laporan/pembayaran', 'LaporanController@showLaporanPembayaranForm')->name('laporan.pembayaran.form');
Route::get('laporan/kasmasuk/pdf', 'LaporanController@kasmasukPdf')->name('kasmasukPdf');
Route::get('laporan/kasmasuk', 'LaporanController@showLaporanKasmasukForm')->name('laporan.kasmasuk.form');
Route::get('laporan/kasmkeluar/pdf', 'LaporanController@kaskeluarPdf')->name('kaskeluarPdf');
Route::get('laporan/kaskeluar', 'LaporanController@showLaporanKaskeluarForm')->name('laporan.kaskeluar.form');



