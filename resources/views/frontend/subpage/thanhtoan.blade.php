@extends("frontend.index")
@section('content')
<!-- Page title -->
<div class="page-title parallax parallax1">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="page-title-heading">
					<h1 class="title">Thanh Toán</h1>
				</div><!-- /.page-title-heading -->
				<div class="breadcrumbs">
					<ul>
						<li><a href="/">Trang Chủ</a></li>
						<li><a href="giohang">Giỏ Hàng</a></li>
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
				<div class="product-content product-fourcolumn clearfix">
					<form class="form-horizontal" method="post" action="shopping/donhang">
						{{ csrf_field() }}
						<div class="row">
							<div class="col-md-1"></div>
							<div class="col-lg-5 col-md-5 col-sm-5col-xs-12 col-md-pull-5 col-sm-pull-5">
								<!--SHIPPING METHOD-->
                                <?php $sum_sale=0;  $pr_sale=0; $sum=0;$total_coupon=0;?>
                                @foreach($sanpham as $sp)
                                    <?php
                                        if($sp->options->price_sale!=0){
                                            $sum+=$sp->price*$sp->qty;
                                            $sum_sale+=($sp->options->price_sale*$sp->qty);
                                            $pr_sale=$sum-$sum_sale;
                                        }
                                    ?>
                                @endforeach
								<div class="panel panel-info">
									<div class="thanhtoan alert alert-primary" role="alert">
										Thông tin thanh toán
									</div>
									<div class="panel-body">

										<div class="form-group">
											<label for="exampleInputEmail1">Họ Tên </label>
											<input type="text" class="form-control"
											 id="exampleInputEmail1" placeholder="thay đổi tên người nhận vui lòng nhập vào đây"
											name="hoten"aria-describedby="emailHelp" >
										</div>
										<div class="form-group">
											<label for="exampleInputPassword1">Địa chỉ</label>
											<input type="text" class="form-control" id="exampleInputPassword1"
                                                   placeholder="thay đổi địa chỉ nhận hàng vui lòng nhập vào đây"
                                                   name="diachi">
										</div>
										<div class="form-group">
											<label for="inputAddress">Phone</label>
											<input type="text" class="form-control" id="inputAddress"
                                                   placeholder="thay đổi số điện thoại nhận hàng vui lòng nhập vào đây"
                                                   name="sdt">
										</div>
										<div class="form-group">
											<label for="exampleInputPassword1">Tổng Tiền</label>
											<input type="text" class="form-control" readonly
											value="{{\Cart::subtotal(0,3)}}"
											id="exampleInputPassword1" name="tongtien">
										</div>
                                        @if(Session::get('coupon'))
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Tổng Tiền đã giảm</label>
                                            @foreach(Session::get('coupon') as $cou)
                                                <?php $total_coupon=$cou['coupon_money']; ?>
                                             <input type="hidden" class="form-control" value="{{$cou['coupon_id']}}" name='coupon_id'>
                                            <input type="text" class="form-control" readonly
                                                   value="{{(number_format(str_replace(',', '', \Cart::subtotal(0,3))-$pr_sale-$total_coupon))}}"
                                                   id="exampleInputPassword1" name="tongtien_sale">
                                             @endforeach
                                        </div>
                                         @else
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Tổng Tiền đã giảm</label>
                                                <input type="text" class="form-control" readonly
                                                       value="{{(number_format(str_replace(',', '', \Cart::subtotal(0,3))-$pr_sale))}}"
                                                       id="exampleInputPassword1" name="tongtien_sale">
                                            </div>
                                        @endif
										<div class="form-group">
											<label for="inputAddress">Ghi chú</label>
											<textarea class="form-control" name="ghichu" id="" cols="30" rows="10"></textarea>
										</div>

									</div>
									<button type="submit" name="dangky" class="submit btn btn-primary">Thanh Toán</button>
								</div>
								<!--SHIPPING METHOD END-->

							</div>
							<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 col-md-push-5 col-sm-push-5">
								<!--REVIEW ORDER-->
								<div class="panel panel-info">
									<div class="thanhtoan alert alert-primary" role="alert">
										Thông tin đơn hàng
										<div class="pull-right"><small><a class="afix-1" href="giohang">Sửa giỏ hàng</a></small></div>
									</div>
									<label for="exampleInputEmail1">Đơn hàng </label>
									<div class="panel-body">
										@foreach($sanpham as $sp)
										<div class="form-group">
											<div class="row">
												<div class="col-sm-3 col-xs-3">
													<img class="img-responsive" src="upload/sanpham/{{$sp->options->hinh}}" />
												</div>
												<div class="col-sm-5 col-xs-5">
													<div class="col-xs-12">{{$sp->name}}</div>
													<div class="col-xs-12"><small>Số lượng: <span>{{$sp->qty}}</span></small></div>
												</div>
												<div class="col-sm-4 col-xs-4 text-right">
													<h6>{{number_format(($sp->qty*$sp->price),0,',','.').'đ'}}
                                                        @if($sp->price==0)
                                                            {{'(sản phẩm tặng kèm khuyến mãi)'}}
                                                        @endif
                                                    </h6>
												</div>
											</div>
										</div>
										@endforeach

										<div class="col-xs-12">
											<strong>Tổng Tiền</strong>
											<div class="pull-right"><span>{{str_replace(',', '.', \Cart::subtotal(0,3).'đ')}}</span></div>
										</div>
                                        <div class="col-xs-12">
                                             <small>Khuyến mãi</small>
                                             <div class="pull-right"><span>{{number_format(-$pr_sale,0,',','.').'đ'}}</span></div>
                                         </div>
                                            @if(Session::get('coupon'))
                                         <div class="col-xs-12">
                                             @foreach(Session::get('coupon') as $cou)
                                                 <?php $total_coupon=$cou['coupon_money']; ?>
                                            <small>Giảm giá</small>
                                            <div class="pull-right"><span>{{number_format(-$total_coupon,0,',','.').'đ'}}</span></div>
                                             @endforeach
                                        </div>
                                            @endif
										<div class="col-xs-12">
											<small>Phí</small>
											<div class="pull-right"><span>free ship</span></div>
										</div>
									</div>
									<div class="form-group"><hr /></div>
									<div class="form-group">
										<div class="col-xs-12">
											<strong>Tổng Tiền Thanh Toán</strong>
											<div class="pull-right"><span>{{\App\Helpers\FormatPrice::formatPrice(str_replace(',', '', \Cart::subtotal(0,3))-$pr_sale-$total_coupon)}}</span></div>
										</div>
									</div>
									<!--Paypal payment button -->


									<div id="paypal-button-container"></div>



								</div>
							</div>
							<div class="col-md-1"></div>
							<!--REVIEW ORDER END-->
						</div>
					</form>
				</form>

			</div><!-- /.col-md-12 -->
		</div><!-- /.row -->
	</div><!-- /.container -->

</section><!-- /.flat-row -->

@endsection
@section('script')
<script
src="https://www.paypal.com/sdk/js?client-id=ATQyw2UdZCN8wzG9hyqnckoFU6NOI4kokT3Z3h4XF2g6x-Wbve2rjfjinpcM8E_asHeV3NcDAPejdnOk">
</script>
<script>
	paypal.Buttons({
		createOrder: function(data, actions) {
			return actions.order.create({
				purchase_units: [{
					amount: {
						value: '0.01'
					}
				}]
			});
		}
	}).render('#paypal-button-container');
</script>
@endsection

