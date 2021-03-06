<div id="navigation">
    <!-- Navigation Menu-->
    <ul class="navigation-menu">
        <li class="has-submenu">
            <a href="admin/trangchu"><i class="md md-dashboard"></i>Dashboard</a>
        </li>
       @if(Auth::guard('QuanTri')->user()->quyen[0]->Ten=='danhmuc')
            <li class="has-submenu">
                <a><i class="md md-color-lens"></i>Thể Loại</a>
                <ul class="submenu">
                    <li><a href="admin/theloai/danhsach">Danh sách</a></li>
                    <li><a href="admin/theloai/them">Thêm</a></li>
                </ul>
            </li>
            <li class="has-submenu">
                <a><i class="md md-color-lens"></i>Thuộc Tính</a>
                <ul class="submenu">
                    <li><a href="admin/thuoctinh/danhsach">Danh sách</a></li>
                    <li><a href="admin/thuoctinh/them">Thêm</a></li>
                </ul>
            </li>
            <li class="has-submenu">
                <a><i class="md md-color-lens"></i>Sản Phẩm</a>
                <ul class="submenu">
                    <li><a href="admin/sanpham/danhsach">Danh sách</a></li>
                    <li><a href="admin/sanpham/them">Thêm</a></li>
                </ul>
            </li>

            <li class="has-submenu">
                <a><i class="md md-color-lens"></i>Ảnh Slide</a>
                <ul class="submenu">
                    <li><a href="admin/anhslidesanpham/danhsach">Danh sách</a></li>
                    <li><a href="admin/anhslidesanpham/them">Thêm</a></li>
                </ul>
            </li>

            <li class="has-submenu">
                <a><i class="md md-color-lens"></i>Tin Tức</a>
                <ul class="submenu">
                    <li><a href="admin/tintuc/danhsach">Danh sách</a></li>
                    <li><a href="admin/tintuc/them">Thêm</a></li>
                </ul>
            </li>
            <li class="has-submenu">
                <a><i class="md md-color-lens"></i>Banner</a>
                <ul class="submenu">
                    <li><a href="admin/banner/danhsach">Danh sách</a></li>
                    <li><a href="admin/banner/them">Thêm</a></li>
                </ul>
            </li>
            <li class="has-submenu">
                <a><i class="md md-color-lens"></i>Bộ lọc</a>
                <ul class="submenu">
                    <li><a href="admin/boloc/danhsach">Danh sách</a></li>
                    <li><a href="admin/boloc/them">Thêm</a></li>
                </ul>
            </li>
            <li class="has-submenu">
                <a><i class="md md-color-lens"></i>Góp ý</a>
                <ul class="submenu">
                    <li><a href="admin/gopy/danhsach">Danh sách</a></li>
                    <li><a href="admin/gopy/them">Thêm</a></li>
                </ul>
            </li>
            <li class="has-submenu">
                <a><i class="md md-color-lens"></i>Bình Luận</a>
                <ul class="submenu">
                    <li><a href="admin/binhluan/danhsach">Danh sách</a></li>
                    <li><a href="admin/binhluan/them">Thêm</a></li>
                </ul>
            </li>
            <li class="has-submenu">
                <a><i class="md md-color-lens"></i>Khách hàng</a>
                <ul class="submenu">
                    <li><a href="admin/khachhang/danhsach">Danh sách</a></li>
                    <li><a href="admin/khachhang/them">Thêm</a></li>
                </ul>
            </li>
        @elseif(Auth::guard('QuanTri')->user()->quyen[0]->Ten=='taikhoan')
            <li class="has-submenu">
                <a><i class="md md-color-lens"></i>Nhân viên</a>
                <ul class="submenu">
                    <li><a href="admin/quantri/danhsach">Danh sách</a></li>
                    <li><a href="admin/quantri/them">Thêm</a></li>
                </ul>
            </li>
            <li class="has-submenu">
                <a ><i class="md md-color-lens"></i>Quyền</a>
                <ul class="submenu">
                    <li><a href="admin/quyen/danhsach">Danh sách</a></li>
                    <li><a href="admin/quyen/them">Thêm</a></li>
                </ul>
            </li>
        @else
            <li class="has-submenu">
                <a><i class="md md-redeem"></i>Khuyến mãi</a>
                <ul class="submenu">
                    <li><a href="admin/khuyenmai/danhsach">Danh sách</a></li>
                    <li><a href="admin/khuyenmai/them">Thêm</a></li>
                </ul>
            </li>
            <li class="has-submenu">
                <a><i class="md md-color-lens"></i>TL Mã KM</a>
                <ul class="submenu">
                    <li><a href="admin/theloaimakhuyenmai/danhsach">Danh sách</a></li>
                    <li><a href="admin/theloaimakhuyenmai/them">Thêm</a></li>
                </ul>
            </li>
            {{-- <li class="has-submenu">
                <a><i class="md md-class"></i>Thông tin bảo hành</a>
                <ul class="submenu">
                    <li class="has-submenu">
                        <a>Bảo hành</a>
                        <ul class="submenu">
                            <li><a href="admin/baohanh/danhsach">Danh sách</a></li>
                            <li><a href="admin/baohanh/them">Thêm</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a>Option BH</a>
                        <ul class="submenu">
                            <li><a href="admin/optionbaohanh/danhsach">Danh sách</a></li>
                            <li><a href="admin/optionbaohanh/them">Thêm</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a>Thông tin BH</a>
                        <ul class="submenu">
                            <li><a href="admin/thongtinbaohanh/danhsach">Danh sách</a></li>
                            <li><a href="admin/thongtinbaohanh/them">Thêm</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a>Phiếu bảo hành</a>
                        <ul class="submenu">
                            <li><a href="admin/phieubaohanh/danhsach">Danh sách</a></li>
                            <li><a href="admin/phieubaohanh/danhsach_trungtam">Danh sách phiếu chuyển về trung tâm</a></li>
                            <li><a href="admin/phieubaohanh/them">Thêm</a></li>
                        </ul>
                    </li>
                </ul>
            </li> --}}
            <li class="has-submenu">
                <a><i class="md md-class"></i>Bảng giá sửa chữa linh kiện</a>
                <ul class="submenu">
                    <li><a href="admin/gialinhkien/danhsach">Danh sách</a></li>
                    <li><a href="admin/gialinhkien/them">Thêm</a></li>
                </ul>
            </li>
            <li class="has-submenu">
                <a href="admin/donhang/danhsach"><i class="md md-shopping-cart"></i>Đơn hàng</a>
{{--                <ul class="submenu">--}}
{{--                    <li><a href="admin/donhang/danhsach">Danh sách</a></li>--}}
{{--                    <li><a href="admin/donhang/them">Thêm</a></li>--}}
{{--                </ul>--}}
            </li>
        @endif
    </ul>
    <!-- End navigation menu        -->
</div>
