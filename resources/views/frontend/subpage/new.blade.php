  <!-- ICON BOX -->
        <section class="flat-row row-icon-box style-1 bg-section bg-color-f5f">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="flat-icon-box icon-left w55 circle bg-white style-1 clearfix">
                            <div class="inner no-margin  flat-content-box " data-margin="0 0 0 0" data-mobilemargin="0 0 0 0">
                                <div class="icon-wrap">
                                    <i class="fa fa-truck"></i>
                                </div>
                                <div class="text-wrap">
                                    <h5 class="heading letter-spacing--1"><a href="#">Free Shipping</a></h5>
                                    <p class="desc">Apply order over $99</p>
                                </div>                                
                            </div>
                        </div>
                    </div><!-- /.col-md-3 -->
                    <div class="col-md-3">
                        <div class="flat-icon-box icon-left w55 circle bg-white style-1 clearfix">
                            <div class="inner flat-content-box" data-margin="0 0 0 7px" data-mobilemargin="0 0 0 0">
                                <div class="icon-wrap">
                                    <i class="fa fa-money"></i>
                                </div>
                                <div class="text-wrap">
                                    <h5 class="heading letter-spacing--1"><a href="#">Cash On Delivery</a></h5>
                                    <p class="desc">Internet Trend To Repeat</p>
                                </div>                                    
                            </div>
                        </div>
                    </div><!-- /.col-md-3 -->
                    <div class="col-md-3">
                        <div class="flat-icon-box icon-left w55 circle bg-white style-1 clearfix">
                            <div class="inner flat-content-box" data-margin="0 0 0 46px" data-mobilemargin="0 0 0 0">
                                <div class="icon-wrap">
                                    <i class="fa fa-gift"></i>
                                </div>
                                <div class="text-wrap">
                                    <h5 class="heading letter-spacing--1"><a href="#">Gift For All</a></h5>
                                    <p class="desc">Gift When Subscribe</p>
                                </div>                                    
                            </div>
                        </div>
                    </div><!-- /.col-md-3 -->
                    <div class="col-md-3">
                        <div class="flat-icon-box icon-left w55 circle bg-white style-1 clearfix">
                            <div class="inner flat-content-box" data-margin="0 0 0 62px" data-mobilemargin="0 0 0 0">
                                <div class="icon-wrap">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                                <div class="text-wrap">
                                    <h5 class="heading letter-spacing--1"><a href="#">Opening All Week</a></h5>
                                    <p class="desc">6.00 am - 17.00pm</p>
                                </div>                                    
                            </div>
                        </div>
                    </div><!-- /.col-md-3 -->
                </div>
            </div>
        </section>
        <!-- END ICON BOX -->
<section class="flat-row row-new-latest style-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="title-section margin-bottom-51">
                            <h2 class="title">Tin Tức</h2>
                        </div>
                        <div class="new-latest-wrap">
                            <div class="flat-new-latest post-wrap flat-carousel-box style4 data-effect clearfix" data-auto="false" data-column="3" data-column2="2" data-column3="1" data-gap="30" > 
                                <div class="owl-carousel owl-theme">
                                    @foreach($tintuc as $tt)
                                    <article class="post clearfix">
                                        <div class="featured-post data-effect-item">
                                            <img src="upload/tintuc/{{$tt->Hinh}}" alt="image">
                                            <div class="overlay-effect bg-overlay-black opacity02"></div>
                                        </div> 
                                        <div class="content-post">                                        
                                            <ul class="meta-post">
                                                <li class="date">
                                                    {{date( 'd/m/Y', strtotime($tt->created_at) )}} 
                                                </li>
                                                <li class="author">
                                                    <a href="#">{{$tt->quantri->HoTen}}</a>
                                                </li>                                                
                                            </ul><!-- /.meta-post -->
                                            <div class="title-post">
                                                <h2><a href="chitiettintuc/{{$tt->id}}/{{$tt->TieuDe_KhongDau}}.html">{{$tt->TieuDe}}</a></h2>
                                            </div><!-- /.title-post -->
                                            <div class="entry-post">
                                                <div class="more-link">
                                                    <a href="chitiettintuc/{{$tt->id}}/{{$tt->TieuDe_KhongDau}}.html">Đọc tiếp</a>
                                                </div>
                                            </div>
                                        </div><!-- /.content-post -->                                           
                                    </article>
                                    @endforeach
                                   <!-- /.post -->  
                                </div><!-- /.owl-carousel -->                                                                                    
                            </div>
                        </div>
                            
                    </div>
                </div>
            </div>
        </section>