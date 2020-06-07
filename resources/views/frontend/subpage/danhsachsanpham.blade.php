@extends("frontend.index")
@section('content')
<!-- Page title -->
<div class="page-title parallax parallax1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-title-heading">
                    <h1 class="title">Danh Sách Sản Phẩm</h1>
                </div><!-- /.page-title-heading -->
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="/">TRANG CHỦ</a></li>
                        <li><a >{{$theloai1->Ten}}</a></li>
                    </ul>
                </div><!-- /.breadcrumbs -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.page-title -->
<section class="flat-row main-shop shop-4col">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {{-- hien filter --}}
                <div class="filter-shop bottom_68 clearfix">
                    <p style="color: #f63440" class="showing-product">
                        Tìm được {{count($sanpham)}} trong tổng {{count($tongsanpham)}} sản phẩm
                    </p>
                    <ul class="flat-filter-search">
                        <li>
                            <a  class="show-filter">Filters</a>
                        </li>
                        <li class="search-product"><a  >Search</a></li>
                    </ul>
                </div><!-- /.filte-shop -->

                <div class="box-filter slidebar-shop clearfix">
                    <div class="btn-close"><a><i class="fa fa-times"></i></a></div>
                    <div class="widget widget-sort-by">
                        <h5 class="widget-title">
                            Sort By
                        </h5>
                        <ul>
                            <li><a href="danhmucsanpham/{{$theloai1->id}}/{{$theloai1->Ten_KhongDau}}.html?sort=tang-dan" class="@if($sort==='tang-dan'){{'active'}} @endif">Giá: Tăng dần</a></li>
                            <li><a href="danhmucsanpham/{{$theloai1->id}}/{{$theloai1->Ten_KhongDau}}.html?sort=giam-dan" class="@if($sort==='giam-dan'){{'active'}} @endif">Giá: Giảm dần</a></li>
                        </ul>
                    </div><!-- /.widget-sort-by -->
                    <div class="widget widget-price">
                        <h5 class="widget-title">Giá</h5>
                        <ul>
                            <li><a href="danhsachsanphamtheoboloc?gia=tatca" class="@if($gia==='tatca'){{'active'}} @endif">Tất cả</a></li>
                            <li><a href="danhsachsanphamtheoboloc?gia=5-10"  class="@if($tu==5 && $den==10){{'active'}} @endif">5-10 Triệu</a></li>
                            <li><a href="danhsachsanphamtheoboloc?gia=10-15" class="@if($tu==10 && $den==15){{'active'}} @endif">10-15 Triệu</a></li>
                            <li><a href="danhsachsanphamtheoboloc?gia=15-20" class="@if($tu==15 && $den==20){{'active'}} @endif">15-20 Triệu</a></li>
                            <li><a href="danhsachsanphamtheoboloc?gia=20-30" class="@if($tu==20 && $den==30){{'active'}} @endif">20-30 Triệu</a></li>
                            <li><a href="danhsachsanphamtheoboloc?gia=30-50" class="@if($tu=30 && $den==100){{'active'}} @endif" >Trên 30 Triệu</a></li>

                        </ul>
                    </div><!-- /.widget -->
                    <div class="widget widget-color">
                        <h5 class="widget-title">
                            Dung Lượng
                        </h5>
                        <ul >
                            <li><a  href="danhsachsanphamtheoboloc?dungluong=tatca" class="@if($dungluong==='tatca'){{'active'}} @endif" >Tất cả</a></li>
                            <li><a  href="danhsachsanphamtheoboloc?dungluong=64" class="@if($dungluong==64){{'active'}} @endif" >64GB</a></li>
                            <li><a href="danhsachsanphamtheoboloc?dungluong=128" class="@if($dungluong==128){{'active'}} @endif"> 128GB</a></li>
                            <li><a href="danhsachsanphamtheoboloc?dungluong=256" class="@if($dungluong==256){{'active'}} @endif">256GB </a></li>
                            <li><a href="danhsachsanphamtheoboloc?dungluong=512" class="@if($dungluong==512){{'active'}} @endif">512GB</a></li>
                        </ul>
                    </div><!-- /.widget-color -->
                    <div class="widget widget-size">
                        <h5 class="widget-title">Sim</h5>
                        <ul>
                            <li><a href="danhsachsanphamtheoboloc?sim=tatca" class="@if($sim==='tatca'){{'active'}} @endif">Tất cả</a></li>
                            <li><a href="danhsachsanphamtheoboloc?sim=1" class="@if($sim==1){{'active'}}@endif">1 Sim</a></li>
                            <li><a href="danhsachsanphamtheoboloc?sim=2" class="@if($sim==2){{'active'}}@endif">2 Sim</a></li>
                        </ul>
                    </div><!-- /.widget -->
                </div><!-- /.box-filter -->
                <div class="shop-search clearfix">
                    <form role="search" method="get" class="search-form" action="#">
                        <label>
                            <input type="search" class="search-field" placeholder="Searching …" value="" name="s">
                        </label>
                    </form>
                </div><!-- /.top-serach -->
                <!-- end filter-->

                <div class="product-content product-fourcolumn clearfix">
                    <ul class="product style2">
                        @foreach($sanpham as $sp)
                        <li class="product-item">
                            <div class="product-thumb clearfix">
                                <a href="chitietsanpham/{{$sp->id}}/{{$sp->Ten_KhongDau}}.html">
                                    <img src="upload/sanpham/{{$sp->Hinh}}" alt="image">
                                </a>
                            </div>
                            <div class="product-info clearfix">
                                <span class="product-title">{{$sp->Ten}}</span>
                                <div class="price">
                                    <ins>
                                        <span class="amount">{{number_format($sp->Gia,0,',','.').'đ'}}</span>
                                    </ins>
                                </div>
                            </div>
                            <div class="add-to-cart text-center">
                                <a href="themgiohang/{{$sp->id}}">Thêm giỏ hàng</a>
                            </div>
                            <a href="#" class="like"><i class="fa fa-heart-o"></i></a>
                        </li>
                        @endforeach
                    </ul><!-- /.product -->
                </div><!-- /.product-content -->
                <br>
                <div class="product-pagination text-center margin-top-11 clearfix pull-right">


                </div>
                <div class="col-md-3 offset-md-5 text-center ">{{$sanpham->links()}}</div>

            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.flat-row --></div>
@endsection


