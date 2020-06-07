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
                                <div class="product-thumb clearfix">
                                    <a href="chitietsanpham/{{$spsale->sanpham->id}}/{{$spsale->sanpham->Ten_KhongDau}}.html">
                                        <img src="upload/sanpham/{{$spsale->sanpham->Hinh}}" alt="image">
                                    </a>
                                    <span class="new sale">Sale {{$spsale->ChiTiet}} %</span>
                                </div>
                                <div class="product-info clearfix">
                                    <span class="product-title">{{$spsale->sanpham->Ten}}</span>
                                    <div class="price">
                                        <del>
                                            <span class="regular">{{number_format($spsale->sanpham->Gia,0,',','.').'đ'}}</span>
                                        </del>
                                        <ins>
                                            <span class="amount">{{number_format($spsale->Gia_Sale,0,',','.').'đ'}}</span>
                                        </ins>
                                    </div>
                                </div>
                                <div class="add-to-cart text-center">
                                    <a href="themgiohang/{{$spsale->sanpham->id}}">ADD TO CART</a>
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
