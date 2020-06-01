@extends("frontend.index")
@section('content')
<!-- Page title -->
<div class="page-title parallax parallax1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-title-heading">
                    <h1 class="title">Chi Tiết Tin Tức</h1>
                </div><!-- /.page-title-heading -->
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="/">TRANG CHỦ</a></li>
                    </ul>
                </div><!-- /.breadcrumbs -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.page-title -->

<!-- Blog posts -->
<section class="blog-posts blog-detail">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="post-wrap detail">

                    <article class="post clearfix">
                        <div class="title-post">
                            <h2><a href="blog-detail.html">{{$tintuc->TieuDe}}</a></h2>
                        </div><!-- /.title-post -->
                        <div class="content-post">
                            <ul class="meta-post">
                                <li class="author padding-left-2">
                                    <span>Người đăng:</span><a >{{$tintuc->quantri->HoTen}}</a>
                                </li>
                                <li class="comment">
                                    <a href="#">10 Comment</a>
                                </li>
                                <li class="date">
                                    <span>Thời gian: {{date( 'd/m/Y', strtotime($tintuc->created_at) )}} </span>
                                </li>
                            </ul><!-- /.meta-post -->
                            {!!$tintuc->NoiDung!!}
                        </div><!-- /.content-post -->
                        <div class="direction">
                            <ul class="tags-share clearfix">
                                <li class="float-left">
                                    <div class="tags">
                                        <span>Tags:</span><a href="#">Decoration</a>,
                                        <a href="#">Fashion</a>, <a href="#">Bags</a>
                                    </div><!-- /.tags -->
                                </li>
                                <li class="float-right">
                                   <div class="social-icon">
                                    <ul class="social-list">
                                        <li class="share">Share:</li>
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                                    </ul>
                                </div><!-- /.social-icon --> 
                            </li>
                        </ul>
                    </div><!-- /.direction -->
                </article><!-- /.post -->

            </div><!-- /.post-wrap -->

             
    </div><!-- /.col-md-9 -->
    <div class="col-md-3">
        <div class="sidebar">
            <div class="widget widget_categories">
                <h5 class="widget-title">Thể Loại</h5>
                <ul>
                    @foreach($theloai as $tl)
                    <li><a href="danhmucsanpham/{{$tl->id}}/{{$tl->Ten_KhongDau}}.html">{{$tl->Ten}}</a></li>
                    @endforeach
                </ul>
            </div><!-- /.widget-categories -->
            
            <div class="widget widget-news-latest">
                <h5 class="widget-title">Tin Mới</h5>
                <ul class="popular-news clearfix">
                    @foreach($tinmoi as $tm)
                    <li>                                      
                        <h6>
                            <a href="chitiettintuc/{{$tm->id}}/{{$tm->TieuDe_KhongDau}}.html">{{$tm->TieuDe}}</a>
                        </h6> 
                        <a class="post_meta">{{date( 'd/m/Y', strtotime($tm->created_at) )}}</a>
                    </li>
                    @endforeach
                </ul><!-- /.popular-news -->
            </div><!-- /.widget-news-latest -->

            <div class="widget widget_tag">
                <h5 class="widget-title">Popular Tags</h5>
                <div class="tag-list">
                    <a href="#">All products</a>
                    <a href="#" class="active">Bags</a>
                    <a href="#">Chair</a>
                    <a href="#">Decoration</a>
                    <a href="#">Fashion</a> 
                    <a href="#">Tie</a>
                    <a href="#">Furniture</a>
                    <a href="#">Accesories</a>     
                </div>
            </div><!-- /.widget-tag -->
        </div><!-- /.sidebar -->
    </div><!-- /.col-md-3 -->
</div><!-- /.row -->
</div><!-- /.container -->
</section><!-- /.blog posts -->

@endsection