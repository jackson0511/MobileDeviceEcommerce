<section class="flat-row row-product-project shop-collection">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title-section margin-bottom-41">
                    <h2 class="title">SẢN PHẨM CỦA SHOP</h2>
                </div>
                <ul class="flat-filter style-1 text-center max-width-782 clearfix">
                    <li class="active"><a href="#" data-filter="*">TẤT CẢ SẢN PHẨM</a></li>
                    <li><a href="#" data-filter=".iphone">IPHONE</a></li>
                    <li><a href="#" data-filter=".ipad">IPAD</a></li>
                    <li><a href="#" data-filter=".applewatch">APPLEWATCH</a></li>
                    <li><a href="#" data-filter=".macbook">MACBOOK</a></li>
                    <li><a href="#" data-filter=".phukien">PHỤ KIỆN</a></li>
                </ul>
                <div class="divider h40"></div>
                <div class="product-content product-fourcolumn clearfix">
                    <ul class="product style2 isotope-product clearfix">
                        @foreach($ipad as $ipad)
                            <li class="product-item ipad ">
                                <div class="product-thumb clearfix">
                                    <a href="chitietsanpham/{{$ipad->id}}/{{$ipad->Ten_KhongDau}}.html">
                                        <img src="upload/sanpham/{{$ipad->Hinh}}" alt="image">
                                    </a>
                                </div>
                                <div class="product-info clearfix">
                                    <span class="product-title">{{$ipad->Ten}}</span>
                                    <div class="price">
                                        <ins>
                                            <span class="amount">{{\App\Helpers\FormatPrice::formatPrice($ipad->Gia)}}</span>
                                        </ins>
                                    </div>
                                </div>
                                <div class="add-to-cart text-center">
                                    <a href="themgiohang/{{$ipad->id}}">ADD TO CART</a>
                                </div>
                                <a href="#" class="like"><i class="fa fa-heart-o"></i></a>
                            </li>
                        @endforeach
                        @foreach($iphone as $iphone)
                            <li class="product-item iphone ">
                                <div class="product-thumb clearfix">
                                    <a href="chitietsanpham/{{$iphone->id}}/{{$iphone->Ten_KhongDau}}.html" class="product-thumb">
                                        <img src="upload/sanpham/{{$iphone->Hinh}}" alt="image">
                                    </a>
                                </div>
                                <div class="product-info clearfix">
                                    <span class="product-title">{{$iphone->Ten}}</span>
                                    <div class="price">
                                        <ins>
                                            <span class="amount">{{\App\Helpers\FormatPrice::formatPrice($iphone->Gia)}}</span>
                                        </ins>
                                    </div>
                                </div>
                                <div class="add-to-cart text-center">
                                    <a href="themgiohang/{{$iphone->id}}">ADD TO CART</a>
                                </div>
                                <a href="#" class="like"><i class="fa fa-heart-o"></i></a>
                            </li>
                        @endforeach
                        @foreach($applewatch as $aw)
                            <li class="product-item applewatch">
                                <div class="product-thumb clearfix">
                                    <a href="chitietsanpham/{{$aw->id}}/{{$aw->Ten_KhongDau}}.html" class="product-thumb">
                                        <img src="upload/sanpham/{{$aw->Hinh}}" alt="image">
                                    </a>
                                    <span class="new sale">Sale</span>
                                </div>
                                <div class="product-info clearfix">
                                    <span class="product-title">{{$aw->Ten}}</span>
                                    <div class="price">
                                        <del>
                                            <span class="regular">{{\App\Helpers\FormatPrice::formatPrice($aw->Gia)}}</span>
                                        </del>
                                        <ins>
                                            <span class="amount">{{\App\Helpers\FormatPrice::formatPrice(($aw->Gia)-1000000)}}</span>
                                        </ins>
                                    </div>
                                    <ul class="flat-color-list width-14">
                                        <li>
                                            <a href="#" class="red"></a>
                                        </li>
                                        <li>
                                            <a href="#" class="blue"></a>
                                        </li>
                                        <li>
                                            <a href="#" class="black"></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="add-to-cart text-center">
                                    <a href="themgiohang/{{$aw->id}}">ADD TO CART</a>
                                </div>
                                <a href="#" class="like"><i class="fa fa-heart-o"></i></a>
                            </li>
                        @endforeach
                        @foreach($macbook as $mac)
                            <li class="product-item macbook">
                                <div class="product-thumb clearfix">
                                    <a href="chitietsanpham/{{$mac->id}}/{{$mac->Ten_KhongDau}}.html" class="product-thumb">
                                        <img src="upload/sanpham/{{$mac->Hinh}}" alt="image">
                                    </a>
                                    <span class="new">New</span>
                                </div>
                                <div class="product-info clearfix">
                                    <span class="product-title">{{$mac->Ten}}</span>
                                    <div class="price">
                                        <ins>
                                            <span class="amount">{{\App\Helpers\FormatPrice::formatPrice($mac->Gia)}}</span>
                                        </ins>
                                    </div>
                                </div>
                                <div class="add-to-cart text-center">
                                    <a href="themgiohang/{{$mac->id}}">ADD TO CART</a>
                                </div>
                                <a href="#" class="like"><i class="fa fa-heart-o"></i></a>
                            </li>
                        @endforeach
                        @foreach($phukien as $pk)
                            <li class="product-item phukien">
                                 <div class="product-thumb clearfix">
                                    <a href="chitietsanpham/{{$pk->id}}/{{$pk->Ten_KhongDau}}.html" class="product-thumb">
                                         <img src="upload/sanpham/{{$pk->Hinh}}" alt="image">
                                    </a>
                                    <span class="new">New</span>
                                 </div>
                                 <div class="product-info clearfix">
                                     <span class="product-title">{{$pk->Ten}}</span>
                                     <div class="price">
                                         <ins>
                                             <span class="amount">{{\App\Helpers\FormatPrice::formatPrice($pk->Gia)}}</span>
                                         </ins>
                                      </div>
                                 </div>
                                 <div class="add-to-cart text-center">
                                    <a href="themgiohang/{{$pk->id}}">ADD TO CART</a>
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
