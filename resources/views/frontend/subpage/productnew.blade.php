  <section class="flat-row row-image-box">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title-section margin-bottom-43">
                    <h2 class="title">
                        SẢN PHẨM MỚI
                    </h2>
                </div>
                <div class="wrap-carousel-box">
                    <div class="flat-image-box flat-carousel-box has-arrows arrow-center bg-transparent offset-62 offset-v-24 style-1 data-effect div-h22 clearfix" data-auto="true" data-column="3" data-column2="2" data-column3="1" data-gap="30" >
                        <div class="owl-carousel owl-theme">
                            @foreach($sanpham as $sp)
                            <div class="item data-effect-item">
                                <div class="inner">
                                    <div class="thumb">
                                        <img src="upload/sanpham/{{$sp->Hinh}}" alt="Image">
                                        <div class="elm-btn">
                                            <a href="chitietsanpham/{{$sp->id}}/{{$sp->Ten_KhongDau}}.html" style="font-size: 12px" class="themesflat-button bg-white width-150">{{$sp->Ten}}</a>
                                        </div>
                                        <div class="overlay-effect bg-color-1"></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div> <!-- /.owl-carousel  -->                         
                    </div>
                </div>                            
            </div>
        </div>
    </div><!-- /.container -->
</section>
