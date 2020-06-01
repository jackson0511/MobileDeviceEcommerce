@extends("frontend.index")
@section('content')
<!-- Page title -->
<div class="page-title parallax parallax1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-title-heading">
                    <h1 class="title">Đăng Ký</h1>
                </div><!-- /.page-title-heading -->
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="/">Trang Chủ</a></li>

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
                    <form method="post" action="dangky">
                        {{ csrf_field() }}
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email </label>
                        <input type="email" class="form-control" id="exampleInputEmail1"
                        name="email"aria-describedby="emailHelp" value="{{old('email')}}" placeholder="vui lòng nhập email"
                        >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1"
                        name="password"placeholder="vui lòng nhập password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nhập lại Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="passwordagain"placeholder="vui lòng nhập lại password">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Name</label>
                        <input type="text" class="form-control" value="{{old('name')}}" id="inputAddress" placeholder="vui lòng nhập tên" name="name">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Address</label>
                        <input type="text" class="form-control" value="{{old('diachi')}}" id="inputAddress" placeholder="vui lòng nhập địa chỉ" name="diachi">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Phone</label>
                        <input type="text" class="form-control" value="{{old('sdt')}}" id="inputAddress" placeholder="vui lòng nhập số điện thoại" name="sdt">
                    </div>
                    <button type="submit" name="dangky" class="submit btn btn-primary">Đăng ký</button>
                </form>
            </div>
        </div>

    </div><!-- /.product-content -->
</div><!-- /.col-md-12 -->
</div><!-- /.row -->
</div><!-- /.container -->
</section><!-- /.flat-row -->

@endsection
