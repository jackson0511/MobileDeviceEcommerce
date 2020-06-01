@extends("frontend.index")
@section('content')
<!-- Page title -->
<div class="page-title parallax parallax1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-title-heading">
                    <h1 class="title">Xác Nhận Đăng Ký</h1>
                </div><!-- /.page-title-heading -->
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="/">TRANG CHỦ </a></li>
                    </ul>
                </div><!-- /.breadcrumbs -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.page-title -->
<section class="flat-row main-shop shop-4col">
    <div class="container">
        <div class="row">
             <div class="col-md-12">
                  {{-- hien filter --}}
                  <div class="filter-shop bottom_68 clearfix">

                    <ul class="flat-filter-search">
                        <li>
                            <a  class="show-filter">Filters</a>
                        </li>
                        <li class="search-product"><a  >Search</a></li>
                    </ul>
                </div><!-- /.filte-shop -->
              @include('frontend.subpage.boloc')

            <div class="product-content product-fourcolumn clearfix">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6 col-md-offset-3">
                      @if(count($errors)>0)
                      <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                        {{$err}}
                        <br>
                        @endforeach
                    </div>
                    @endif
                    <div class="clearfix"></div>
                    <!-- /.col-lg-12 -->
                    @if(session('ThongBao'))
                    <div class="alert alert-info">
                        {{session('ThongBao')}}
                    </div>
                    @endif
                    <div class="clearfix"></div>
                    <form method="post" action="xacnhan">
                     {{ csrf_field() }}
                     <div class="form-group">
                        <label for="exampleInputPassword1">Mã xác nhận</label>
                        <input type="text" class="form-control" readonly
                        name="xacnhan" value="{{$code}}"  placeholder="vui lòng nhập mã xác nhận">
                    </div>
                    <button type="submit"  class="submit btn btn-primary">Xác nhận</button>
                </form>
            </div>
        </div>

    </div><!-- /.product-content -->
</div><!-- /.col-md-12 -->
</div><!-- /.row -->
</div><!-- /.container -->
</section><!-- /.flat-row -->

@endsection
