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
                @include('frontend.subpage.filter')
                <!-- end filter-->
                <div class="row d-flex justify-content-end">
                    <div class="col-lg-9">
                        <button class="btn btn-info sosanh">So sánh</button>
                    </div>
                    <div class="col-lg-3  clearfix">
                        <form method="get" id="form_sort">
                            <select class="custom-select custom-select-lg mb-3" id="sort" name="sort">
                                <option
                                    @if($sort=='gia-mac-dinh')
                                        {{'selected'}}
                                    @endif
                                    value="gia-mac-dinh">Mặc định</option>
                                <option
                                    @if($sort=='gia-tang-dan')
                                    {{'selected'}}
                                    @endif
                                    value="gia-tang-dan">Giá tăng dần</option>
                                <option
                                    @if($sort=='gia-giam-dan')
                                    {{'selected'}}
                                    @endif
                                    value="gia-giam-dan">Giá giảm dần</option>
                            </select>
                        </form>
                    </div>
                </div>
                <div class="product-content product-fourcolumn clearfix">
                    <ul class="product style2">
                        @foreach($sanpham as $sp)
                        <li class="product-item">
                            <input type="checkbox" name="sanpham" value="{{$sp->id}}">
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
                            <div class="middle-product table-wrapper-scroll-y table-responsive custom-scrollbar-css">
                                <table class="table table-fixed">
                                    <tbody>
                                    @foreach($sp->chitietthuoctinh as $tt)
                                        <tr>
                                            <td class="properties middle-product-title">{{$tt->thuoctinh->Ten}} :</td>
                                            <td class="properties">{{$tt->ChiTiet}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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
<div style="top: 30%" class="modal" id="myModal">
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">So sánh thông tin sản </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body ">
                <h2 class='text-center mb-5'>Thông tin sản phẩm</h2>
                    <table class="table table-bordered  ketqua" id="dataTables-example">

                    </table>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
@endsection
@section('script')
    <script >
        $(document).ready(function () {
            var arr_id=[];
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("[name=sanpham]").click(function () {
                var id=$(this).val();
                var check=$(this).is(":checked");
                if(check){
                    arr_id.push(id);
                }else{
                    var index=arr_id.indexOf(id);
                    arr_id.splice(index,1);
                }
            });
            $(".sosanh").click(function () {
                if(arr_id.length>0) {
                    $("#myModal").modal('show');
                    $.ajax({
                        method: "POST",
                        url: 'ajax/sosanh-sanpham',
                        data: {
                            id: arr_id,
                        },
                        success: function (data) {
                            if (data != null) {
                                $(".ketqua").html(data);
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection



