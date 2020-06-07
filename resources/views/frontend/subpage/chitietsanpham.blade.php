@extends("frontend.index")
@section('content')
    <!-- Page title -->
    <div class="page-title parallax parallax1">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title-heading">
                        <h1 class="title">Chi Tiết Sản Phẩm</h1>
                    </div>
                    <!-- /.page-title-heading -->
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="/">TRANG CHỦ</a></li>
                            <li><a href="danhmucsanpham/{{$sanpham->theloai->id}}/{{$sanpham->theloai->Ten_KhongDau}}.html">{{$sanpham->theloai->Ten}}</a></li>
                            <li><a>{{$sanpham->Ten}}</a></li>
                        </ul>
                    </div>
                    <!-- /.breadcrumbs -->
                </div>
                <!-- /.col-md-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.page-title -->
    <section class="flat-row main-shop shop-detail" id="content" data-key={{$sanpham->id}}>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="wrap-flexslider">
                        <div class="inner">
                            <div class="flexslider style-1 has-relative">
                                <ul class="slides">
                                    @foreach($sanpham->anhslidesp as $anhsl)
                                        <li data-thumb="upload/anhslidesp/{{$anhsl->AnhDuoi}}">
                                            <img src="upload/anhslidesp/{{$anhsl->AnhTren}}" alt="Image">
                                            <div class="flat-icon style-1">
                                                <a href="upload/anhslidesp/{{$anhsl->AnhTren}}" class="zoom-popup"><span class="fa fa-search-plus"></span></a>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- /.flexslider -->
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
                <div class="col-md-6">
                    <div class="product-detail">
                        <div class="inner">
                            <div class="content-detail">
                                <h2 class="product-title">{{$sanpham->Ten}}</h2>
                                <div class="flat-star style-1">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <span>(1)</span>
                                </div>
                                <p>{!!$sanpham->TomTat!!}</p>
                                <div class="price">
                                    @if(count($ctkhuyenmai)>0)
                                    @foreach($ctkhuyenmai as $km)
                                        <?php $ngaybatdau=$km->khuyenmai->NgayBatDau; $ngaykethuc=$km->khuyenmai->NgayKetThuc; ?>
                                        @if($ngay>=$ngaybatdau && $ngay<=$ngaykethuc && $km->khuyenmai->TrangThai==1)
                                            <del><span class="regular">{{number_format($sanpham->Gia,0,',','.').'đ'}}</span></del>
                                            <ins><span class="amount">{{number_format($km->Gia_Sale,0,',','.').'đ'}}</span></ins>
                                            @break
                                        @endif
                                    @endforeach
                                        @if($ngay>$ngaykethuc || $ngay<$ngaybatdau)
                                            <ins><span class="amount">{{number_format($sanpham->Gia,0,',','.').'đ'}}</span></ins>
                                        @endif
                                    @else
                                    <ins><span class="regular">{{number_format($sanpham->Gia,0,',','.').'đ'}}</span></ins>
                                    @endif
                                </div>
                                <br>
                                <div class="row">
                                    @foreach($product_type as $pro_type)
                                        @if($pro_type->idTL==1 || $pro_type->idTL==2)
                                        <div class="col-lg-3">
                                            <div class="
                                            @if($pro_type->id==$sanpham->id)
                                                {{'active-product'}}
                                            @endif
                                            product-related">
                                                <a href="chitietsanpham/{{$pro_type->id}}/{{$pro_type->Ten_KhongDau}}.html">
                                                    @foreach($pro_type->chitietthuoctinh as $ct)
                                                        @if($ct->thuoctinh->Ten=='Dung lượng')
                                                            <div class="product-related-gb text-center">{{$ct->ChiTiet}}</div>
                                                        @endif
                                                    @endforeach
                                                    <div class="product-related-price text-center">{{number_format($pro_type->Gia,0,',','.').'đ'}}</div>
                                                </a>
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                </div>
                                <ul class="product-infor style-1">
                                </ul>
                                <div class="product-quantity">
                                    <div class="quantity">
                                        <input type="text" value="1" name="quantity-number" class="quantity-number">
                                        <span class="inc quantity-button">+</span>
                                        <span class="dec quantity-button">-</span>
                                    </div>
                                    <div class="add-to-cart">
                                        <a href="themgiohang/{{$sanpham->id}}">Thêm giỏ hàng</a>
                                    </div>
                                    <div class="box-like">
                                        <a href="#" class="like"><i class="fa fa-heart-o"></i></a>
                                    </div>
                                </div>
                                <div class="product-categories">
                                    <span>Thể Loại: </span><a href="chitietsanpham/{{$sanpham->theloai->id}}/{{$sanpham->theloai->Ten_KhongDau}}.html">{{$sanpham->theloai->Ten}}</a>
                                </div>
                                <div class="product-tags">
                                    <span>Tags: </span><a href="#">Ipad</a> <a href="#">Macbook</a> <a href="#">Applewatch</a>
                                </div>
                                <ul class="flat-socials">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /.product-detail -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /.flat-row -->
    <section class="flat-row shop-detail-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="flat-tabs style-1 has-border">
                        <div class="inner">
                            <ul class="menu-tab">
                                <li class="active">Nội Dung</li>
                                <li>Thông Tin</li>
                                <li>Bình Luận </li>
                            </ul>
                            <div class="content-tab">
                                <div class="content-inner">
                                    <div class="flat-grid-box col2 border-width border-width-1 has-padding clearfix">
                                        {!!$sanpham->NoiDung!!}
                                    </div>
                                </div>
                                <!-- /.content-inner -->
                                <div class="content-inner">
                                    <div style="list-style: none;" class="inner max-width-40 ">
                                        <table>
                                            <tbody>
                                            @foreach($sanpham->chitietthuoctinh as $tt)
                                                <tr>
                                                    <td>{{$tt->thuoctinh->Ten}}</td>
                                                    <td>{{$tt->ChiTiet}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.content-inner -->
                                <div class="content-inner">
                                    <div class="inner max-width-83 padding-top-33">
                                        <ol class="review-list">
                                            {{--                         show binh luan--}}
                                            <li class="ketqua">
                                            </li>
                                            @foreach($sanpham->binhluan as $bl)
                                                <li class="review">
                                                    <div class="thumb">
                                                        <img src="images/images.png" alt="Image">
                                                    </div>
                                                    <div class="text-wrap">
                                                        <div class="review-text">
                                                            <h3>{{$bl->khachhang->HoTen}}</h3>
                                                            <p>{{$bl->NoiDung}}</p>
                                                            <p>Thời gian:{{$bl->created_at}} </p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <!--  /.review    -->
                                            @endforeach
                                            {{--                         ket thuc binh luan --}}
                                        </ol>
                                        <!-- /.review-list -->
                                        @if(Auth::guard('KhachHang')->check())
                                            <div class="comment-respond review-respond" id="respond">
                                                <div class="comment-reply-title margin-bottom-14">
                                                    <h5>Viết bình luận</h5>
                                                </div>
                                                <form class="comment-form review-form" id="commentform" method="get">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" id="idsp" value="{{$sanpham->id}}">
                                                    <p class="comment-form-comment">
                                                        <label>Nội dung*</label>
                                                        <textarea class="" tabindex="4" id="noidung"  name="noidung" required> </textarea>
                                                    </p>
                                                    <p class="form-submit">
                                                        {{--                           <button class="comment-submit" id="binhluan">Bình Luận</button>--}}
                                                        <input type="reset" id="binhluan" value="Bình Luận">
                                                    </p>
                                                </form>
                                            </div>
                                            <!-- /.comment-respond -->
                                        @endif
                                    </div>
                                </div>
                                <!-- /.content-inner -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.shop-detail-content -->
    <section class="flat-row shop-related">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-section margin-bottom-55">
                        <h2 class="title">Sản Phẩm Liên Quan</h2>
                    </div>
                    <div class="product-content product-fourcolumn clearfix">
                        <ul class="product style2">
                            @foreach($sanphamlienquan as $splq)
                                <li class="product-item">
                                    <div class="product-thumb clearfix">
                                        <a href="chitietsanpham/{{$splq->id}}/{{$splq->Ten_KhongDau}}.html">
                                            <img src="upload/sanpham/{{$splq->Hinh}}" alt="image">
                                        </a>
                                    </div>
                                    <div class="product-info clearfix">
                                        <span class="product-title">{{$splq->Ten}}</span>
                                        <div class="price">
                                            <ins>
                                                <span class="amount">{{\App\Helpers\FormatPrice::formatPrice($splq->Gia)}}</span>
                                            </ins>
                                        </div>
                                    </div>
                                    <div class="add-to-cart text-center">
                                        <a href="#">THÊM GIỎ HÀNG</a>
                                    </div>
                                    <a href="#" class="like"><i class="fa fa-heart-o"></i></a>
                                </li>
                            @endforeach
                        </ul>
                        <!-- /.product -->
                    </div>
                    <!-- /.product-content -->
                </div>
            </div>
            <!-- /.row -->
        </div>
    </section>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $("#binhluan").click(function(){
            var idsp=$("#idsp").val();
            var noidung=$("#noidung").val();
            if(noidung==" "){
                alert('Bạn chưa nhập nội dung mà!!!');
            }
            $.ajax({
                method: "get",
                url: 'ajax/binhluan',
                data: {
                    noidung:noidung,
                    idsp:idsp
                },
                success: function (data) {
                    if(data!=null) {
                        $(".ketqua").prepend(data);
                        alert('Viết bình luận thành công');
                    }
                }
            });

            // $.get("binhluan/"+idsp+"/"+noidung,function(data){
            // $(".ketqua").prepend(data);
    });
});
    $(function(){
      let idproduct=$("#content").attr("data-key");
      let products=localStorage.getItem('products');
       if(products==null){
          arrayProduct=new Array();
          arrayProduct.push(idproduct);
          localStorage.setItem('products',JSON.stringify(arrayProduct));
       }else{
        //chuyen ve mang
        products=$.parseJSON(products);
        if(products.indexOf(idproduct)==-1)
        {
          products.push(idproduct);
          localStorage.setItem('products',JSON.stringify(products));
        }
       }
    });
</script>
@endsection
