<section class="flat-row row-best-sale">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="title-section margin-bottom-43">
                            <h2 class="title">
                                SẢN PHẨM VỪA XEM

                            </h2>
                            <p><a href="danhsachsanphamvuaxem/{{$id}}">xem tất cả</a></p>

                        </div>
                        <div class="product-content product-fivecolumn clearfix">
                            <ul class="product style3">
                                @foreach($sanphamview as $spview)
                                <li class="product-item">
                                    <div class="product-thumb clearfix">
                                        <a href="chitietsanpham/{{$spview->id}}/{{$spview->Ten_KhongDau}}.html">
                                            <img src="upload/sanpham/{{$spview->Hinh}}" alt="image">
                                        </a>
                                    </div>
                                    <div class="product-info clearfix">
                                        <div class="product-title">{{$spview->Ten}}</div>
                                        <div class="price">
                                            <ins>
                                                <span class="amount">{{number_format($spview->Gia,0,',','.').'đ'}}</span>
                                            </ins>
                                        </div>
                                    </div>
                                    <div class="add-to-cart text-center">
                                        <a href="themgiohang/{{$spview->id}}">Thêm giỏ hàng</a>
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
