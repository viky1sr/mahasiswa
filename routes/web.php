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

Route::get('/', 'SiteController@home' );
Route::get('/register','SiteController@register');
Route::get('/about', 'SiteController@about' );
Route::post('/postregister','SiteController@postregister');

Route::get('/login','AuthController@login')->name('login');
Route::get('/logout','AuthController@logout');
Route::post('/postlogin','AuthController@postlogin');

Route::group(['middleware' => ['auth','chekRole:admin']], function (){
    Route::get('/siswa', 'SiswaController@index');
    Route::post('/siswa/create','SiswaController@create');
    Route::get('/siswa/{siswa}/edit','SiswaController@edit');
    Route::post('/siswa/{siswa}/update','SiswaController@update');
    Route::get('/siswa/{siswa}/delete','SiswaController@delete');
    Route::get('/siswa/{siswa}/profile','SiswaController@profile');
    Route::post('/siswa/{siswa}/addnilai','SiswaController@addnilai');
    Route::get('/siswa/{siswa}/{idmakul}/deletenilai','SiswaController@deletenilai');
    Route::get('/siswa/exportexcel','SiswaController@exportExcel');
    Route::get('/siswa/exportpdf','SiswaController@exportPdf');
    Route::post('/siswa/import','SiswaController@importExcel')->name('siswa.import');
    Route::get('/dosen','GuruController@index')->name('dosen.index');
    Route::get('/guru/{id}/profile','GuruController@profile');
    Route::get('/posts','PostController@index')->name('posts.index');
    Route::get('/posts/{post}/delete','PostController@delete');
    Route::get('/posts/{post}/edit','PostController@edit');
    Route::post('/posts/{post}/update','PostController@update');
    Route::get('/posts/add',[
        'uses' =>  'PostController@add',
        'as' => 'posts.add',
    ]);

    Route::post('post/create',[
        'uses' =>  'PostController@create',
        'as' => 'posts.create',
    ]);

});
Route::group(['middleware' => ['auth','chekRole:admin,siswa']], function () {
    Route::get('/dasboard', 'DashboardController@index');
});

Route::group(['middleware' => 'auth','cekRole:siswa'], function () {
    Route::get('/myprofile','SiswaController@myprofile');
});

Route::get('getdataguru', [
    'uses' => 'GuruController@getdataguru',
    'as' => 'ajax.get.data.guru',
]);

Route::get('getdatasiswa', [
   'uses' => 'SiswaController@getdatasiswa',
   'as' => 'ajax.get.data.siswa',
]);

Route::get('/{slug}',[
    'uses' => 'SiteController@singlepost',
    'as' => 'site.single.post'
]);



