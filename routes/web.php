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
    Route::resource('jenis','JenisController');
    Route::resource('merk','MerkController');
    Route::resource('kategori','KategoriController');
    Route::resource('berita','BeritaController');
    Route::resource('barang','BarangController');
    Route::resource('fotbar','FotoBarangController');


Auth::routes();
Route::get('guest','FrontEndController@foto_barang');
Route::get('shop','FrontEndController@shop');
Route::get('barang/{barang}','FrontEndController@single');
Route::get('/home', 'HomeController@index')->name('home');
