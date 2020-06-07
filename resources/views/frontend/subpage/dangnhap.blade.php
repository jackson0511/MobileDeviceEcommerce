@extends("frontend.index")
@section('content')
<!-- Page title -->
<div class="page-title parallax parallax1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-title-heading">
                    <h1 class="title">Đăng Nhập</h1>
                </div><!-- /.page-title-heading -->
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="/">Home</a></li>
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
                    <form method="post" action="dangnhap">
                        {{ csrf_field() }}
                         <div class="form-group">
                            <label for="exampleInputEmail1">Email </label>
                            <input type="email" class="form-control" id="exampleInputEmail1"
                            name="email"aria-describedby="emailHelp" value="{{old('email')}}" placeholder="vui lòng nhập email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1"
                            name="password"placeholder="vui lòng nhập password">
                        </div>
                        <button type="submit" name="dangnhap" class="submit btn btn-primary">Đăng Nhập</button>
                    </form>
            </div>
        </div>

    </div><!-- /.product-content -->
</div><!-- /.col-md-12 -->
</div><!-- /.row -->
</div><!-- /.container -->
</section><!-- /.flat-row -->

@endsection
