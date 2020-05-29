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

//dang nhap admin
Route::get('admin/dangnhap','AdminController@getLogin');
Route::post('admin/dangnhap','AdminController@postLogin');

Route::get('admin/logout','AdminController@getLogout');

Route::group(['prefix'=>'admin'],function() {
    //trang chu admin
    Route::get('trangchu','AdminController@index');

    //theloai

    Route::group(['prefix'=>'theloai','middleware'=>'CheckLoginAdmin:danhmuc'],function (){
       Route::get('danhsach','TheLoaiController@getList');
       Route::get('them','TheLoaiController@getAdd');
       Route::post('them','TheLoaiController@postAdd');
       Route::get('sua/{id}','TheLoaiController@getEdit');
       Route::post('sua/{id}','TheLoaiController@postEdit');
       Route::get('xoa/{id}','TheLoaiController@getDelete');
       Route::get('xuly/{id}','TheLoaiController@getXuLy');
    });
    //anh slide san pham
    Route::group(['prefix'=>'anhslidesanpham','middleware'=>'CheckLoginAdmin:danhmuc'],function (){
        Route::get('danhsach','AnhSlideSanPhamController@getList');
        Route::get('them','AnhSlideSanPhamController@getAdd');
        Route::post('them','AnhSlideSanPhamController@postAdd');
        Route::get('sua/{id}','AnhSlideSanPhamController@getEdit');
        Route::post('sua/{id}','AnhSlideSanPhamController@postEdit');
        Route::get('xoa/{id}','AnhSlideSanPhamController@getDelete');
    });
    //thuoctinh
    Route::group(['prefix'=>'thuoctinh','middleware'=>'CheckLoginAdmin:danhmuc'],function (){
        Route::get('danhsach','ThuocTinhController@getList');
        Route::get('them','ThuocTinhController@getAdd');
        Route::post('them','ThuocTinhController@postAdd');
        Route::get('sua/{id}','ThuocTinhController@getEdit');
        Route::post('sua/{id}','ThuocTinhController@postEdit');
        Route::get('xoa/{id}','ThuocTinhController@getDelete');
    });

    //banner
    Route::group(['prefix'=>'banner','middleware'=>'CheckLoginAdmin:danhmuc'],function (){
        Route::get('danhsach','BannerController@getList');
        Route::get('them','BannerController@getAdd');
        Route::post('them','BannerController@postAdd');
        Route::get('sua/{id}','BannerController@getEdit');
        Route::post('sua/{id}','BannerController@postEdit');
        Route::get('xoa/{id}','BannerController@getDelete');
    });
    //tintuc
    Route::group(['prefix'=>'tintuc','middleware'=>'CheckLoginAdmin:danhmuc'],function (){
        Route::get('danhsach','TinTucController@getList');
        Route::get('them','TinTucController@getAdd');
        Route::post('them','TinTucController@postAdd');
        Route::get('sua/{id}','TinTucController@getEdit');
        Route::post('sua/{id}','TinTucController@postEdit');
        Route::get('xoa/{id}','TinTucController@getDelete');
    });
    //khachhang
    Route::group(['prefix'=>'khachhang','middleware'=>'CheckLoginAdmin:danhmuc'],function (){
        Route::get('danhsach','KhachHangController@getList');

        Route::get('xuly/{id}','KhachHangController@getXuLy');
    });
    //gopy
    Route::group(['prefix'=>'gopy','middleware'=>'CheckLoginAdmin:danhmuc'],function (){
        Route::get('danhsach','GopYController@getList');
        Route::get('xuly/{id}','GopYController@getXuLy');
    });
    //gopy
    Route::group(['prefix'=>'binhluan','middleware'=>'CheckLoginAdmin:danhmuc'],function (){
        Route::get('danhsach','BinhLuanController@getList');
        Route::get('xuly/{id}','BinhLuanController@getXuLy');
    });
    //quantri
    Route::group(['prefix'=>'quantri','middleware'=>'CheckLoginAdmin:taikhoan'],function (){
        Route::get('danhsach','QuanTriController@getList');
        Route::get('them','QuanTriController@getAdd');
        Route::post('them','QuanTriController@postAdd');
        Route::get('sua/{id}','QuanTriController@getEdit');
        Route::post('sua/{id}','QuanTriController@postEdit');
        Route::get('xoa/{id}','QuanTriController@getDelete');
    });
    //quyen
    Route::group(['prefix'=>'quyen','middleware'=>'CheckLoginAdmin:taikhoan'],function (){
        Route::get('danhsach','QuyenController@getList');
        Route::get('them','QuyenController@getAdd');
        Route::post('them','QuyenController@postAdd');
        Route::get('sua/{id}','QuyenController@getEdit');
        Route::post('sua/{id}','QuyenController@postEdit');
        Route::get('xoa/{id}','QuyenController@getDelete');
    });

});
//frontend
Route::get('/','HomeController@index');
//chi tiet san pham
Route::get('chitietsanpham/{id}/{Ten_KhongDau}.html','HomeController@productDetail');
//login
Route::get('dangnhap','HomeController@getLogin');
Route::post('dangnhap','HomeController@postLogin');
//register
Route::get('dangky','HomeController@getRegister');
Route::post('dangky','HomeController@postRegister');

Route::group(['prefix'=>'ajax'],function (){
   Route::get('sanpham_theloai','AjaxController@getProductToCategory');
});
