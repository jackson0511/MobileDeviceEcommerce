<section class="flat-row row-best-sale">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if($title!='')
                <div class="title-section margin-bottom-43">
                    <h2 class="title">
                        {{$title}}

                    </h2>
                    <p><a href="sanphamkhuyenmai">xem tất cả</a></p>

                </div>
                @endif
                <div class="product-content product-fivecolumn clearfix">
                    <ul class="product style3">
                        @foreach($sanphamsale as $spsale)
                            <li class="product-item">
                                <div class="product-thumb  clearfix">
                                    <a href="chitietsanpham/{{$spsale->sanpham->id}}/{{$spsale->sanpham->Ten_KhongDau}}.html">
                                        <img src="upload/sanpham/{{$spsale->sanpham->Hinh}}" alt="image">
                                    </a>
                                    @if($spsale->TrangThai==1)
                                        <span class="new sale">Sale {{$spsale->ChiTiet}} %</span>
                                    @else
                                        @foreach($product_km as $pr_km)
                                            @if($pr_km->id==(int)$spsale->ChiTiet)
                                                <span style="width: 100px; font-size: 12px" class="new sale">Tặng {{$pr_km->Ten}}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                <div class="product-info clearfix">
                                    <div class="product-title">{{$spsale->sanpham->Ten}}</div>
                                    <div class="price">
                                        <del>
                                            <span class="regular">{{number_format($spsale->sanpham->Gia,0,',','.').'đ'}}</span>
                                        </del>
                                        <ins>
                                            @if($spsale->Gia_Sale!=null)
                                            <span class="amount">{{number_format($spsale->Gia_Sale,0,',','.').'đ'}}</span>
                                            @else
                                                <span class="amount">{{number_format($spsale->sanpham->Gia,0,',','.').'đ'}}</span>
                                            @endif
                                        </ins>
                                    </div>
                                </div>
                                <div class="add-to-cart text-center">
                                    <a href="themgiohang/{{$spsale->sanpham->id}}">Thêm giỏ hàng</a>
                                </div>
                                <a href="#" class="like"><i class="fa fa-heart-o"></i></a>
                            </li>
                        @endforeach
                    </ul><!-- /.product -->
                </div><!-- /.product-content -->
            </div>
        </div><!-- /.row -->
    </div><!-- /.container -->
</section>
