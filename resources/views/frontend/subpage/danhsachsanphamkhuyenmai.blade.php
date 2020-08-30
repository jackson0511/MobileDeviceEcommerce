@extends("frontend.index")
@section('content')
<!-- Page title -->
<div class="page-title parallax parallax1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-title-heading">
                    <h1 class="title">Danh Sách Sản Phẩm Khuyến Mãi</h1>
                </div><!-- /.page-title-heading -->
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="/">TRANG CHỦ</a></li>
{{--                        <li><a >{{$theloai1->Ten}}</a></li>--}}
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
                        Tìm được {{count($sanphamsale)}} trong tổng {{count($tongsanpham)}} sản phẩm
                    </p>
{{--                    <ul class="flat-filter-search">--}}
{{--                        <li>--}}
{{--                            <a  class="show-filter">Filters</a>--}}
{{--                        </li>--}}
{{--                        <li class="search-product"><a  >Search</a></li>--}}
{{--                    </ul>--}}
                </div><!-- /.filte-shop -->
{{--                @include('frontend.subpage.filter')--}}

                <div class="product-content product-fourcolumn clearfix">
                    <ul class="product style2">
                        @foreach($sanphamsale as $sp)
                        <li class="product-item">
                            <div class="product-thumb product-thumb-four clearfix">
                                <a href="chitietsanpham/{{$sp->sanpham->id}}/{{$sp->sanpham->Ten_KhongDau}}.html">
                                    <img src="upload/sanpham/{{$sp->sanpham->Hinh}}" alt="image">
                                </a>
                                @if($sp->TrangThai==1)
                                    <span class="new sale">Sale {{$sp->ChiTiet}} %</span>
                                @else
                                    @foreach($product_km as $pr_km)
                                        @if($pr_km->id==(int)$sp->ChiTiet)
                                            <span style="width: 100px; font-size: 12px" class="new sale">Tặng {{$pr_km->Ten}}</span>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                            <div class="product-info clearfix">
                                <div class="product-title">{{$sp->sanpham->Ten}}</div>
                                <div class="price">
                                    <del>
                                        <span class="regular">{{number_format($sp->sanpham->Gia,0,',','.').'đ'}}</span>
                                    </del>
                                    <ins>
                                        @if($sp->Gia_Sale!=null)
                                            <span class="amount">{{number_format($sp->Gia_Sale,0,',','.').'đ'}}</span>
                                        @else
                                            <span class="amount">{{number_format($sp->sanpham->Gia,0,',','.').'đ'}}</span>
                                        @endif
                                    </ins>
                                </div>
                            </div>
                            <div class="add-to-cart text-center">
                                <a href="themgiohang/{{$sp->sanpham->id}}">Thêm giỏ hàng</a>
                            </div>
                            <a href="#" class="like"><i class="fa fa-heart-o"></i></a>
                        </li>
                        @endforeach
                    </ul><!-- /.product -->
                </div><!-- /.product-content -->
                <br>
                <div class="product-pagination text-center margin-top-11 clearfix pull-right">


                </div>
                <div class="col-md-3 offset-md-5 text-center ">{{$sanphamsale->links()}}</div>

            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.flat-row --></div>
@endsection


