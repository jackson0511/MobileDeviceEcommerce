@extends("frontend.index")
@section('content')
<!-- Page title -->
<div class="page-title parallax parallax1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-title-heading">
                    <h1 class="title">Danh Sách Tin Tức</h1>
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
<section class="blog-posts grid-posts">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="post-wrap margin-bottom-26">
                            <div class="grid three">

                               @foreach($tintuc as $tt)
                                <article class="post clearfix">
                                    <div class="featured-post">
                                        <img width="500px" src="upload/tintuc/{{$tt->Hinh}}" alt="image">
                                    </div>
                                    <div class="content-post">
                                        <div style="height: 80px" class="title-post">
                                            <h2><a href="chitiettintuc/{{$tt->id}}/{{$tt->TieuDe_KhongDau}}.html">{{$tt->TieuDe}}</a></h2>
                                        </div><!-- /.title-post -->
                                        <div class="entry-post">
                                            <div class="more-link">
                                                <a href="chitiettintuc/{{$tt->id}}/{{$tt->TieuDe_KhongDau}}.html">Đọc tiếp</a>
                                            </div>
                                        </div>
                                    </div><!-- /.content-post -->
                                </article><!-- /.post -->
                                @endforeach

                            </div><!-- /.grid -->
                        </div><!-- /.post-wrap -->
                        <div class="col-md-3 offset-md-5">{{$tintuc->links()}}</div>
                    </div><!-- /.col-md-12 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.blog posts -->
<style>
    .pagination {
        color: #f63440;
    }
</style>
@endsection
