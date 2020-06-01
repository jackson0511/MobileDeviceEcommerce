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

Route::group(['prefix'=>'admin','middleware'=>'CheckLoginAdmin'],function() {
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
    //khuyemai
    Route::group(['prefix'=>'khuyenmai','middleware'=>'CheckLoginAdmin:kinhdoanh'],function (){
        Route::get('danhsach','KhuyenMaiController@getList');
        Route::get('them','KhuyenMaiController@getAdd');
        Route::post('them','KhuyenMaiController@postAdd');
        Route::get('sua/{id}','KhuyenMaiController@getEdit');
        Route::post('sua/{id}','KhuyenMaiController@postEdit');
        Route::get('xoa/{id}','KhuyenMaiController@getDelete');
    });
    //makhuyemai
    Route::group(['prefix'=>'makhuyenmai','middleware'=>'CheckLoginAdmin:kinhdoanh'],function (){
        Route::get('danhsach','MaKhuyenMaiController@getList');
        Route::get('them','MaKhuyenMaiController@getAdd');
        Route::post('them','MaKhuyenMaiController@postAdd');
        Route::get('sua/{id}','MaKhuyenMaiController@getEdit');
        Route::post('sua/{id}','MaKhuyenMaiController@postEdit');
        Route::get('xoa/{id}','MaKhuyenMaiController@getDelete');
        Route::get('xuly/{id}','MaKhuyenMaiController@getXuLy');
    });

});
//frontend
Route::get('/','HomeController@index');
//chi tiet san pham
Route::get('chitietsanpham/{id}/{Ten_KhongDau}.html','HomeController@productDetail');
//danh sach san pham theo the loai
Route::get('danhmucsanpham/{id}/{Ten_KhongDau}.html','HomeController@productByCategory');
//danh sach san pham ban chay
Route::get('sanphambanchay','HomeController@getDanhsachbanchay');
//danh sach san pham vua xem
Route::get('danhmuctintuc','HomeController@getListNews');
//chi tiet tin tuc
Route::get('chitiettintuc/{id}/{TenDe_KhongDau}.html','HomeController@getDetailNew');
//danh sach tin tuc
Route::get('danhsachsanphamvuaxem/{id}','HomeController@getListProductView');
//login
Route::get('dangnhap','HomeController@getLogin');
Route::post('dangnhap','HomeController@postLogin');
//register
Route::get('dangky','HomeController@getRegister');
Route::post('dangky','HomeController@postRegister');
//logout
Route::get('logout','HomeController@getLogout');
//gui ma xac nhan khi dang ky
Route::get('xacnhan','HomeController@getXacnhan')->name('get.link.xacnhan');
Route::post('xacnhan','HomeController@postXacnhan');
//thong tin tai khoan
Route::get('taikhoan','HomeController@getAccount');
Route::post('taikhoan','HomeController@postAccount');
// tim kiem
Route::get('timkiem','HomeController@getTimkiem');
//cart
Route::get('themgiohang/{id}','ShoppingCartController@addToCart');
Route::get('giohang','ShoppingCartController@showCart');
Route::get('xoagiohang/{idCart}','ShoppingCartController@deleteCart');
//check coupom
Route::post('check-coupon','ShoppingCartController@check_coupon');
Route::get('xoa-coupon','ShoppingCartController@delete_coupon');
//cam on
Route::get('camon','HomeController@getCamon');
//thanhtoan
Route::group(['prefix'=>'shopping','middleware'=>'CheckLoginKhachHang'],function(){
    Route::get('donhang','ShoppingCartController@getOrder');
    Route::post('donhang','ShoppingCartController@postOrder');
});
//viet gop ý
Route::group(['prefix'=>'gopy','middleware'=>'CheckLoginKhachHang'],function(){
    Route::get('lienhe','HomeController@getContact');

    Route::post('lienhe','HomeController@postContact');
});
Route::group(['prefix'=>'ajax'],function (){
   Route::get('sanpham_theloai','AjaxController@getProductToCategory');
   //binhluan
   Route::get('binhluan','AjaxController@getComment');
   //product view
   Route::post('sanphamview/{id}','AjaxController@postProductview');
   //kiem tra mat khau cu
   Route::get('kiemtramatkhaucu','AjaxController@getKiemtramatkhau');
   //tim kiem
   Route::post('timkiem','AjaxController@postTimkiem');
   //chi tiet khuyen mai
    Route::post('chitietkhuyenmai','AjaxController@postChitietkhuyenmai');

});
