<style type="text/css">
</style>
<!-- Top Bar -->
<div id="top-bar">
    <div id="top-bar-inner" class="container">
        <div class="top-bar-inner-wrap">
            <div class="top-bar-content">
                <span class="content"><img width="50px" height="50px" src="images/apple.png"> APPLE</span>
            </div>
            <div class="top-bar-nav">

                <div class="inner">
                    <div class="money">

                    </div>
                    <div class="money">
{{--                         <p style="text-align: center;">{{sw_get_current_weekday()}}  <span id="clock"></span></p> --}}
                    </div>
                    @if(Auth::guard('KhachHang')->check())
                    <div class="language-wrap">
                        <ul class="language">
                            <li>
                                <a href="">Xin chào : {{Auth::guard('KhachHang')->user()->HoTen}} </a><i class="fa fa-user"></i>
                                <ul class="sub-language">
                                    <li><a href="giohang">Giỏ Hàng</a></li>
                                    <li><a href="donhangcuaban/{{Auth::guard('KhachHang')->user()->id}}">Đơn hàng</a></li>
                                    <li><a href="taikhoan">Tài Khoản</a></li>
                                    <li><a href="logout">Đăng Xuất</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    @else
                    <div  class="money"><a href="dangnhap">Đăng nhập</a> </div>
                    <div  class="money"><a href="dangky">Đăng ký</a></div>
                @endif
            </div>
        </div>
    </div>
</div>
</div>
<!-- End Top Bar -->
<!-- Header -->
<header id="header" class="header header-container clearfix">
    <div class="container clearfix" id="site-header-inner">
        <div id="logo" class="logo float-left">
            <a href="/" title="logo">
                <img src="images/logo2.png" alt="image" width="107" height="24" data-retina="images/logo2.png" data-width="107" data-height="24">
            </a>
        </div><!-- /.logo -->
        <div class="mobile-button"><span></span></div>
        <ul class="menu-extra">

            <li class="box-search">
                <a class="icon_search header-search-icon" href="#"></a>
                <form role="search" method="get" action="timkiem" class="header-search-form">
                     {{ csrf_field() }}
                    <input type="text" id="tukhoa" name="tukhoa" class="header-search-field" placeholder="Tìm kiếm...">
                  <div class="header-search-field" id="ketqua"></div>
                   <button type="submit"  title="Search">Tìm</button>
                </form>
            </li>

            <li class="box-login">
                <a class="icon_login" href="#"></a>
            </li>
            <li class="box-cart nav-top-cart-wrapper">
{{--                <a class="icon_cart nav-cart-trigger active" href="giohang"><span>{{Cart::count()}}</span></a>--}}
                <div class="nav-shop-cart">
                    <div class="widget_shopping_cart_content">
                        <div class="woocommerce-min-cart-wrap">
                            <ul class="woocommerce-mini-cart cart_list product_list_widget ">
                                <li class="woocommerce-mini-cart-item mini_cart_item">
                                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-md-push-12 col-sm-push-12">
                                <!--REVIEW ORDER-->
                                <div class="panel panel-info">

{{--                                    <div class="panel-body">--}}
{{--                                        <?php $sum=0; ?>--}}
{{--                                        @foreach(Cart::content() as $sp)--}}
{{--                                        <div class="form-group">--}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col-sm-3 col-xs-3">--}}
{{--                                                    <img src="upload/sanpham/{{$sp->options->hinh}}" />--}}
{{--                                                </div>--}}
{{--                                                <div class="col-sm-5 col-xs-5">--}}
{{--                                                    <div style="font-size: 10px">{{$sp->name}}</div>--}}
{{--                                                    <div style="font-size: 10px">Số lượng:{{$sp->qty}}</div>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-sm-4 col-xs-4 text-right">--}}
{{--                                                    <h6>{{formatPrice($sp->qty*$sp->price)}}</h6>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                           <?php $sum+=$sp->price*$sp->qty?>--}}
{{--                                        @endforeach--}}

{{--                                        <div class="col-xs-12">--}}
{{--                                            <strong>Tổng Tiền</strong>--}}
{{--                                            <div class="col-md-4 pull-right"><span>{{formatPrice($sum)}}</span></div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                                </li>
                            </ul>
                        </div><!-- /.widget_shopping_cart_content -->
                    </div>
                </div><!-- /.nav-shop-cart -->
            </li>
        </ul><!-- /.menu-extra -->
        <div class="nav-wrap">
            <nav id="mainnav" class="mainnav">
                <ul class="menu">

                    <li class="active">
                        <a href="/">TRANG CHỦ</a>
                    </li>
                    @foreach($theloai as $tl)
                        <li>
                            <a href="danhmucsanpham/{{$tl->id}}/{{$tl->Ten_KhongDau}}.html">{{$tl->Ten}}</a>
                        </li>
                    @endforeach
{{--                    @foreach($theloai as $tl)--}}
{{--                        @if($tl->parent_id==0)--}}
{{--                            <li>--}}
{{--                                <a href="danhmucsanpham/{{$tl->id}}/{{$tl->Ten_KhongDau}}.html">{{$tl->Ten}}</a>--}}
{{--                                @foreach($tl->children as $child)--}}
{{--                                    <ul class="submenu">--}}
{{--                                        <a href="danhmucsanpham/{{$child->id}}/{{$child->Ten_KhongDau}}.html">{{$child->Ten}}</a>--}}
{{--                                    </ul>--}}
{{--                                @endforeach--}}
{{--                            </li>--}}
{{--                        @endif--}}
{{--                    @endforeach--}}
                     <li>
                        <a href="danhmuctintuc">TIN TỨC</a>
                    </li>
                       <li>
                        <a href="gopy/lienhe">LIÊN HỆ</a>
                    </li>

                </ul>
            </nav><!-- /.mainnav -->
        </div><!-- /.nav-wrap -->
    </div><!-- /.container-fluid -->
            </header><!-- /header -->
            <style>
                #ketqua{
                    padding-left: 5px;
                }
            </style>
