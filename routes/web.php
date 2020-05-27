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

//Route::get('/', function () {
//    return view('welcome');
//});
//dang nhap admin
Route::get('admin/dangnhap','AdminController@getLogin');
Route::post('admin/dangnhap','AdminController@postLogin');

Route::get('admin/logout','AdminController@getLogout');

Route::group(['prefix'=>'admin'],function() {
    //trang chu admin
    Route::get('trangchu','AdminController@index');

    //theloai

    Route::group(['prefix'=>'theloai'],function (){
       Route::get('danhsach','TheLoaiController@getList');
       Route::get('them','TheLoaiController@getAdd');
       Route::post('them','TheLoaiController@postAdd');
       Route::get('sua/{id}','TheLoaiController@getEdit');
       Route::post('sua/{id}','TheLoaiController@postEdit');
       Route::get('xoa/{id}','TheLoaiController@getDelete');
       Route::get('xuly/{id}','TheLoaiController@getXuLy');
    });
    //anh slide san pham
    Route::group(['prefix'=>'anhslidesanpham'],function (){
        Route::get('danhsach','AnhSlideSanPhamController@getList');
        Route::get('them','AnhSlideSanPhamController@getAdd');
        Route::post('them','AnhSlideSanPhamController@postAdd');
        Route::get('sua/{id}','AnhSlideSanPhamController@getEdit');
        Route::post('sua/{id}','AnhSlideSanPhamController@postEdit');
        Route::get('xoa/{id}','AnhSlideSanPhamController@getDelete');
    });
    //thuoctinh
    Route::group(['prefix'=>'thuoctinh'],function (){
        Route::get('danhsach','ThuocTinhController@getList');
        Route::get('them','ThuocTinhController@getAdd');
        Route::post('them','ThuocTinhController@postAdd');
        Route::get('sua/{id}','ThuocTinhController@getEdit');
        Route::post('sua/{id}','ThuocTinhController@postEdit');
        Route::get('xoa/{id}','ThuocTinhController@getDelete');
    });

    //banner
    Route::group(['prefix'=>'banner'],function (){
        Route::get('danhsach','BannerController@getList');
        Route::get('them','BannerController@getAdd');
        Route::post('them','BannerController@postAdd');
        Route::get('sua/{id}','BannerController@getEdit');
        Route::post('sua/{id}','BannerController@postEdit');
        Route::get('xoa/{id}','BannerController@getDelete');
    });

});

Route::get('/','HomeController@index');
