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
    //sanpham
    Route::group(['prefix'=>'sanpham','middleware'=>'CheckLoginAdmin:danhmuc'],function (){
        Route::get('danhsach','SanPhamController@getList');
        Route::get('them','SanPhamController@getAdd');
        Route::post('them','SanPhamController@postAdd');
        Route::get('sua/{id}','SanPhamController@getEdit');
        Route::post('sua/{id}','SanPhamController@postEdit');
        Route::get('xoa/{id}','SanPhamController@getDelete');
    });
    //bo loc
    Route::group(['prefix'=>'boloc','middleware'=>'CheckLoginAdmin:danhmuc'],function (){
        Route::get('danhsach','BoLocController@getList');
        Route::get('them','BoLocController@getAdd');
        Route::post('them','BoLocController@postAdd');
        Route::get('sua/{id}','BoLocController@getEdit');
        Route::post('sua/{id}','BoLocController@postEdit');
        Route::get('xoa/{id}','BoLocController@getDelete');
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
    //binhluan
    Route::group(['prefix'=>'binhluan','middleware'=>'CheckLoginAdmin:danhmuc'],function (){
        Route::get('danhsach','BinhLuanController@getList');
        Route::get('traloi/{id}','BinhLuanController@getTraloi');
        Route::post('traloi/{id}','BinhLuanController@postTraloi');
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
    Route::group(['prefix'=>'theloaimakhuyenmai','middleware'=>'CheckLoginAdmin:kinhdoanh'],function (){
        Route::get('danhsach','TheLoaiMaKhuyenMaiController@getList');
        Route::get('them','TheLoaiMaKhuyenMaiController@getAdd');
        Route::post('them','TheLoaiMaKhuyenMaiController@postAdd');
        Route::get('sua/{id}','TheLoaiMaKhuyenMaiController@getEdit');
        Route::post('sua/{id}','TheLoaiMaKhuyenMaiController@postEdit');
        Route::get('xoa/{id}','TheLoaiMaKhuyenMaiController@getDelete');
        Route::get('xuly/{id}','TheLoaiMaKhuyenMaiController@getXuLy');
    });
    //baohang
    Route::group(['prefix'=>'baohanh','middleware'=>'CheckLoginAdmin:kinhdoanh'],function (){
        Route::get('danhsach','BaoHanhController@getList');
        Route::get('them','BaoHanhController@getAdd');
        Route::post('them','BaoHanhController@postAdd');
        Route::get('sua/{id}','BaoHanhController@getEdit');
        Route::post('sua/{id}','BaoHanhController@postEdit');
        Route::get('xoa/{id}','BaoHanhController@getDelete');
    });
    //option bao hanh
    Route::group(['prefix'=>'optionbaohanh','middleware'=>'CheckLoginAdmin:kinhdoanh'],function (){
        Route::get('danhsach','OptionBaoHanhController@getList');
        Route::get('them','OptionBaoHanhController@getAdd');
        Route::post('them','OptionBaoHanhController@postAdd');
        Route::get('sua/{id}','OptionBaoHanhController@getEdit');
        Route::post('sua/{id}','OptionBaoHanhController@postEdit');
        Route::get('xoa/{id}','OptionBaoHanhController@getDelete');
    });
    //thong tin bao hanh
    Route::group(['prefix'=>'thongtinbaohanh','middleware'=>'CheckLoginAdmin:kinhdoanh'],function (){
        Route::get('danhsach','ThongTinBaoHanhController@getList');
        Route::post('danhsach','ThongTinBaoHanhController@search');
        Route::post('option_baohanh','ThongTinBaoHanhController@getListOption');
    });
    //donhang
    Route::group(['prefix'=>'donhang','middleware'=>'CheckLoginAdmin:kinhdoanh'],function (){
        Route::get('danhsach','DonHangController@getList');
        Route::post('danhsach','DonHangController@filter_status');
        Route::get('print-order/{order_id}','DonHangController@print_order');
        //them imei cho chitiet san pham
        Route::get('xuly/{id}','DonHangController@getXuly');
        Route::post('xuly/{id}','DonHangController@postXuly');
        //xu ly don hang
        Route::get('xulydonhang/{id}','DonHangController@getXulydonhang');
        Route::post('xulydonhang/{id}','DonHangController@postXulydonhang');
        //xu ly cong lai so luong
        Route::get('xulyhuy/{id}','DonHangController@getXulyhuy');
        //filter status
//        Route::post('filter-status','DonHangController@filter_status');

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
//danh sach san pham khuyen mai
Route::get('sanphamkhuyenmai','HomeController@getDanhsachkhuyenmai');
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
Route::post('update-cart','ShoppingCartController@update_cart');
Route::get('xoagiohang/{idCart}','ShoppingCartController@deleteCart');
//check coupom
Route::post('check-coupon','ShoppingCartController@check_coupon');
Route::get('xoa-coupon','ShoppingCartController@delete_coupon');
//share coupon
Route::post('share-coupon','HomeController@share_coupon');

//xem don hang
Route::get('donhangcuaban/{id}','HomeController@danh_sach_don_hang');
//xem chi tiet don hang
Route::post('chitietdonhang','HomeController@getChitietdonhang');
//huy don hang khi chua xu ly
Route::get('huydonhang/{iddh}','HomeController@getHuydonhang');
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
    //ma khuyen mai
    Route::post('makhuyenmai','AjaxController@postMakhuyenmai');
    //show thuoc tinh theo the loai
    Route::post('show-thuoc-tinh','AjaxController@postShowthuoctinh');
    //chi tiet don hang
    Route::post('chitietdonhang','AjaxController@chitietdonhang');
    //filter
    Route::post('product-filter','AjaxController@product_filter');
    //so sanh san pham
    Route::post('sosanh-sanpham','AjaxController@sosanh_sanpham');

});
