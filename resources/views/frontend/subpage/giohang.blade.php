@extends("frontend.index")
@section('content')
<!-- Page title -->
<div class="page-title parallax parallax1">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="page-title-heading">
          <h1 class="title">Giỏ Hàng</h1>
        </div><!-- /.page-title-heading -->
        <div class="breadcrumbs">
          <ul>
            <li><a href="/">TRANG CHỦ</a></li>
            <li><a href="giohang">GIỎ HÀNG</a></li>
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

                    <ul class="flat-filter-search">
                        <li>
                            <a  class="show-filter">Filters</a>
                        </li>
                        <li class="search-product"><a  >Search</a></li>
                    </ul>
                </div><!-- /.filte-shop -->
              @include('frontend.subpage.boloc')

          @if(session('ThongBao'))
        <div class="alert alert-success">
          {{session('ThongBao')}}
        </div>
      @endif
      <div class="product-content product-fourcolumn clearfix">


        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên</th>
                <th scope="col">Hình</th>
                <th scope="col">Số Lượng</th>
                <th scope="col">Giá</th>
                <th scope="col">Tổng Tiền</th>
                <th scope="col">Quản Lý</th>
              </tr>
            </thead>
            <tbody>
              <?php $sum_sale=0; $stt=1; $pr_sale=0;$sum=0;?>
              @foreach($sanpham as $key=> $sp)

              <tr>
                <td>{{$stt}}</td>
                <td>{{$sp->name}}</td>
                <td>
                  <img width="100px" height="100px" src="upload/sanpham/{{$sp->options->hinh}}" alt="">
                </td>
                <td><input class="soluong" type="number" name="soluong" value="{{$sp->qty}}" min=0 style="width: 50px">
                <input type="hidden" name="idsp" class="idsp"  value="{{$sp->id}}" >
                </td>
                <td>{{\App\Helpers\FormatPrice::formatPrice($sp->price)}}</td>
                <td class="tien">{{\App\Helpers\FormatPrice::formatPrice(($sp->price*$sp->qty))}}</td>
                <td >
                  <i class="fa fa-pencil  fa-fw " ></i><a class="updatecart" data-key={{$key}}> Sửa</a>-
                  <i class="fa fa-trash-o fa-fw"></i> <a href="xoagiohang/{{$key}}">Xoá</a>
                </td>
              </tr>
               <?php
                   if($sp->options->price_sale!=0){
                       $sum+=$sp->price*$sp->qty;
                       $sum_sale+=($sp->options->price_sale*$sp->qty);
                       $pr_sale=$sum-$sum_sale;
                   }
                   $stt++;
               ?>
              @endforeach
            </tbody>
          </table>
            <div style="float: left;" class="col-md-6 pull-left">
                <div class="row">
                    <div class="col-lg-12">
                        @if(session('error'))
                            <div class="alert alert-danger">
                            {{session('error')}}
                            </div>
                        @elseif(session('success'))
                            <div class="alert alert-success">
                                {{session('success')}}
                            </div>
                        @endif
                    </div>
                </div>
                <form  action="check-coupon" method="post">
                    {{csrf_field()}}
                     <div class="form-check form-inline mb-2 mr-2">
                         <input class="form-check-input mr-2 coupon"  type="checkbox" id="inlineFormCheck">
                         <label style="color: #337ab7; font-size: 14px" class="form-check-label" for="inlineFormCheck">
                             Mã khuyến mãi
                         </label>
                     </div>
                    <div class="show-coupon" style="display: none">
                        <div class="form-group col-lg-8 mb-3 p-0">
                            <input type="text" class="form-control"  name="coupon"  placeholder="Mã khuyến mãi">
                        </div>
                         <div class="form-group col-lg-10 p-0">
                            <button class="btn btn-primary">Áp dụng</button>
                         </div>
                    </div>
                </form>
            </div>
          <div  style="float: right;" class="col-md-6 pull-right" >
            <ul class="list-group">
             <li class="list-group-item list-group-item-dark">Thông tin đơn hàng</li>
             <li class="list-group-item d-flex justify-content-between align-items-center">
              Tạm tính:
              <span class="badge badge-secondary badge-pill text-danger" style="font-size: 20px">{{str_replace(',', '.', \Cart::subtotal(0,3).'đ')}}</span>
             </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  Khuyến mãi:
                  <span class="badge badge-secondary badge-pill text-danger" style="font-size: 20px">{{number_format(-$pr_sale,0,',','.').'đ'}}</span>
                </li>
                <?php $total_coupon=0; ?>
                @if(Session::get('coupon'))
                <li class="list-group-item d-flex justify-content-between align-items-center">
                     Giảm giá:
                    @foreach(Session::get('coupon') as $cou)
                    <?php $total_coupon=$cou['coupon_money']; ?>
                    <span class="badge badge-secondary badge-pill text-danger pr-0" style="font-size: 20px">{{number_format(-$cou['coupon_money'],0,',','.').'đ'}}  <a href="xoa-coupon"><i class="fa fa-close fa-fw"></i> </a></span>
                    @endforeach
                </li>
                @endif
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  Tổng tiền:
                  <span class="badge badge-secondary badge-pill text-danger " style="font-size: 20px">{{\App\Helpers\FormatPrice::formatPrice(str_replace(',', '', \Cart::subtotal(0,3))-$pr_sale-$total_coupon)}}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <a style="margin-right: 5px" href="/" class="btn btn-danger">Tiếp tục mua hàng</a>
                  <a href="shopping/donhang" class="btn btn-danger">Thanh toán</a>
                </ul>
              </div>
            </div>
          </div><!-- /.product-content -->
        </div><!-- /.col-md-12 -->
      </div><!-- /.row -->
    </div><!-- /.container -->
  </section><!-- /.flat-row -->
  @endsection
@section('script')
   <script>
      $(document).ready(function(){
         $(".updatecart").click(function(){
            var soluong=$(this).parents("tr").find(".soluong").val();
            var idcart=$(this).attr("data-key");
            var idsp=$(this).parents("tr").find(".idsp").val();
            // alert(soluong);
            $.get("suagiohang/"+idcart+"/"+soluong+"/"+idsp+"/",function(data){
              $(".tien").append(data);
               if(data==1){
                  alert("cap nhap thanh cong");
                   location.reload();
                 }else{
                    alert("cap nhap that bai");
                   location.reload();
                 }
            });
         });
      });
      $(document).ready(function () {
        $('.coupon').change(function () {
            if($(this).is(":checked")){
                $('.show-coupon').css('display','block')
            }else{
                $('.show-coupon').css('display','none')
            }
        });
      });
   </script>
@endsection
