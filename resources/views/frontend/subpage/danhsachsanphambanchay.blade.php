@extends("frontend.index")
@section('content')
<!-- Page title -->
<div class="page-title parallax parallax1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-title-heading">
                    <h1 class="title">Danh Sách Sản Phẩm Bán Chạy</h1>
                </div><!-- /.page-title-heading -->
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="/">TRANG CHỦ</a></li>
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
                @include('frontend.subpage.boloc')

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
                                <a href="#">Thêm giỏ hàng</a>
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
</section><!-- /.flat-row -->

@endsection


