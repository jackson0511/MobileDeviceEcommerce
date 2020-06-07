<div id="view">

</div>
<section class="flat-row row-best-sale">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title-section margin-bottom-43">
                    <h2 class="title">
                        SẢN PHẨM BÁN CHẠY

                    </h2>
                    <p><a href="sanphambanchay">xem tất cả</a></p>

                </div>
                <div class="product-content product-fivecolumn clearfix">
                    <ul class="product style3">
                        @foreach($sanphamhot as $sphot)
                        <li class="product-item">
                            <div class="product-thumb clearfix">
                                <a href="chitietsanpham/{{$sphot->id}}/{{$sphot->Ten_KhongDau}}.html">
                                    <img src="upload/sanpham/{{$sphot->Hinh}}" alt="image">
                                </a>
                                <span class="new sale">Sale</span>
                            </div>
                            <div class="product-info clearfix">
                                <span class="product-title">{{$sphot->Ten}}</span>
                                <div class="price">
                                    <ins>
                                        <span class="amount">{{number_format($sphot->Gia,0,',','.').'đ'}}</span>
                                    </ins>
                                </div>
                            </div>
                            <div class="add-to-cart text-center">
                                <a href="themgiohang/{{$sphot->id}}">ADD TO CART</a>
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
