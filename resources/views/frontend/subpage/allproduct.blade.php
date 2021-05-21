<section class="flat-row row-product-project shop-collection">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title-section margin-bottom-41">
                    <h2 class="title">SẢN PHẨM CỦA SHOP</h2>
                </div>
                <ul class="flat-filter style-1 text-center max-width-782 clearfix">
                    <li class="active"><a href="#" data-filter="*">TẤT CẢ SẢN PHẨM</a></li>
                    <li><a href="#" data-filter=".apple">APPLE</a></li>
                    <li><a href="#" data-filter=".samsung">SAMSUNG</a></li>
                    <li><a href="#" data-filter=".xiaomi">XIAOMI</a></li>
                    <li><a href="#" data-filter=".oppo">OPPO</a></li>
                    <li><a href="#" data-filter=".phukien">PHỤ KIỆN</a></li>
                </ul>
                <div class="divider h40"></div>
                <div class="product-content product-fourcolumn clearfix">
                    <ul class="product style2 isotope-product clearfix">
                        @foreach($apple as $appleProd)
                            <li class="product-item apple ">
                                <div class="product-thumb product-thumb-four clearfix">
                                    <a href="chitietsanpham/{{$appleProd->id}}/{{$appleProd->Ten_KhongDau}}.html">
                                        <img src="upload/sanpham/{{$appleProd->Hinh}}" alt="image">
                                    </a>
                                </div>
                                <div class="product-info clearfix">
                                    <div class="product-title">{{$appleProd->Ten}}</div>
                                    <div class="price">
                                        <ins>
                                            <span class="amount">{{number_format($appleProd->Gia,0,',','.').'đ'}}</span>
                                        </ins>
                                    </div>
                                </div>
                                <div class="add-to-cart text-center">
                                    <a href="themgiohang/{{$appleProd->id}}">Thêm giỏ hàng</a>
                                </div>
                                <a href="#" class="like"><i class="fa fa-heart-o"></i></a>
                            </li>
                        @endforeach
                        @foreach($samsung as $samsungProd)
                            <li class="product-item samsung ">
                                <div class="product-thumb product-thumb-four clearfix">
                                    <a href="chitietsanpham/{{$samsungProd->id}}/{{$samsungProd->Ten_KhongDau}}.html" class="product-thumb">
                                        <img src="upload/sanpham/{{$samsungProd->Hinh}}" alt="image">
                                    </a>
                                </div>
                                <div class="product-info clearfix">
                                    <div class="product-title">{{$samsungProd->Ten}}</div>
                                    <div class="price">
                                        <ins>
                                            <span class="amount">{{number_format($samsungProd->Gia,0,',','.').'đ'}}</span>
                                        </ins>
                                    </div>
                                </div>
                                <div class="add-to-cart text-center">
                                    <a href="themgiohang/{{$samsungProd->id}}">Thêm giỏ hàng</a>
                                </div>
                                <a href="#" class="like"><i class="fa fa-heart-o"></i></a>
                            </li>
                        @endforeach
                        @foreach($xiaomi as $xiaomiProd)
                            <li class="product-item xiaomi">
                                <div class="product-thumb product-thumb-four clearfix">
                                    <a href="chitietsanpham/{{$xiaomiProd->id}}/{{$xiaomiProd->Ten_KhongDau}}.html" class="product-thumb">
                                        <img src="upload/sanpham/{{$xiaomiProd->Hinh}}" alt="image">
                                    </a>
                                    <span class="new sale">Sale</span>
                                </div>
                                <div class="product-info clearfix">
                                    <div class="product-title">{{$xiaomiProd->Ten}}</div>
                                    <div class="price">
                                        <ins>
                                            <span class="amount">{{number_format($xiaomiProd->Gia,0,',','.').'đ'}}</span>
                                        </ins>
                                    </div>
                                </div>
                                <div class="add-to-cart text-center">
                                    <a href="themgiohang/{{$xiaomiProd->id}}">Thêm giỏ hàng</a>
                                </div>
                                <a href="#" class="like"><i class="fa fa-heart-o"></i></a>
                            </li>
                        @endforeach
                        @foreach($oppo as $oppoiProd)
                            <li class="product-item oppo">
                                <div class="product-thumb product-thumb-four clearfix">
                                    <a href="chitietsanpham/{{$oppoiProd->id}}/{{$oppoiProd->Ten_KhongDau}}.html" class="product-thumb">
                                        <img src="upload/sanpham/{{$oppoiProd->Hinh}}" alt="image">
                                    </a>
                                    <span class="new">New</span>
                                </div>
                                <div class="product-info clearfix">
                                    <div class="product-title">{{$oppoiProd->Ten}}</div>
                                    <div class="price">
                                        <ins>
                                            <span class="amount">{{number_format($oppoiProd->Gia,0,',','.').'đ'}}</span>
                                        </ins>
                                    </div>
                                </div>
                                <div class="add-to-cart text-center">
                                    <a href="themgiohang/{{$oppoiProd->id}}">Thêm giỏ hàng</a>
                                </div>
                                <a href="#" class="like"><i class="fa fa-heart-o"></i></a>
                            </li>
                        @endforeach
                        @foreach($phukien as $pk)
                            <li class="product-item phukien">
                                 <div class="product-thumb product-thumb-four clearfix">
                                    <a href="chitietsanpham/{{$pk->id}}/{{$pk->Ten_KhongDau}}.html" class="product-thumb">
                                         <img src="upload/sanpham/{{$pk->Hinh}}" alt="image">
                                    </a>
                                    <span class="new">New</span>
                                 </div>
                                 <div class="product-info clearfix">
                                     <div class="product-title">{{$pk->Ten}}</div>
                                     <div class="price">
                                         <ins>
                                             <span class="amount">{{number_format($pk->Gia,0,',','.').'đ'}}</span>
                                         </ins>
                                      </div>
                                 </div>
                                 <div class="add-to-cart text-center">
                                    <a href="themgiohang/{{$pk->id}}">Thêm giỏ hàng</a>
                                 </div>
                                    <a href="#" class="like"><i class="fa fa-heart-o"></i></a>
                             </li>
                         @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
