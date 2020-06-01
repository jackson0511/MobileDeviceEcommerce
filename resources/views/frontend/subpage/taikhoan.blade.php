@extends("frontend.index")
@section('content')
<!-- Page title -->
<div class="page-title parallax parallax1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-title-heading">
                    <h1 class="title">Thông Tin Tài Khoản</h1>
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
                    <form method="post" action="taikhoan">
                        {{ csrf_field() }}
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email </label>
                        <input type="email" class="form-control" id="exampleInputEmail1"
                        name="email"aria-describedby="emailHelp" value="{{$khachhang->Email}}" disabled="true" placeholder="vui lòng nhập email">
                    </div>
                        <div class="row">
                          <div class="col-lg-7 " style="color: red">click vào đây để có nhu cầu đổi password</div>
                            <div class="col-lg-2">
                            <input  type="checkbox" class="form-control" id="changepass"  name="checkpassword">
                            </div>
                        </div>
                    <div class="form-group " style="position: relative;">

                        <label for="exampleInputPassword1">Password Old</label>
                        <input type="password" class="passwordold form-control password"
                           disabled="true" id="exampleInputPassword1" placeholder="nhập mật khẩu cũ"
                        name="passwordold">
                        <a style="position: absolute;top:57%;right: 25px" href="javascript:;void(0)" ><i class="fa fa-eye"></i></a>
                    </div>
                        <div style="color: red" class="ketqua ">
                        </div>
                     <div class="form-group" style="position: relative;">
                        <label for="exampleInputPassword1"> Password</label>
                        <input type="password" class="form-control password" disabled="true" id="exampleInputPassword1" name="password" placeholder="nhập mật khẩu mới">
                        <a style="position: absolute; top:54%;right: 25px" href="javascript:;void(0)" ><i class="fa fa-eye"></i></a>
                    </div>
                    <div class="form-group" style="position: relative;">
                        <label for="exampleInputPassword1">Nhập lại Password</label>
                        <input type="password" class="form-control password" disabled="true" id="exampleInputPassword1" name="passwordagain" placeholder="nhập lại mậy khẩu">
                        <a style="position: absolute;top:54%;right: 25px" href="javascript:;void(0)" ><i class="fa fa-eye"></i></a>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Name</label>
                        <input type="text" class="form-control" value="{{$khachhang->HoTen}}"  placeholder="vui lòng nhập tên" name="name" >
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Address</label>
                        <input type="text" class="form-control" value="{{$khachhang->DiaChi}}"  placeholder="vui lòng nhập địa chỉ" name="diachi">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Phone</label>
                        <input type="text" class="form-control" value="{{$khachhang->SoDienThoai}}"  placeholder="vui lòng nhập số điện thoại" name="sdt">
                    </div>
                    <button type="submit" name="dangky" class="submit btn btn-primary">Cập nhập</button>
                </form>
            </div>
        </div>

    </div><!-- /.product-content -->
</div><!-- /.col-md-12 -->
</div><!-- /.row -->
</div><!-- /.container -->
</section><!-- /.flat-row -->
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $("#changepass").change(function(){
                if($(this).is(":checked")){
                    $(".password").removeAttr('disabled')
                }else{
                    $(".password").attr('disabled','')
                }
            });
        });
    </script>
    {{-- kiem tra mat khau cu --}}
    <script>
        $(document).ready(function(){
            $(".passwordold").blur(function(){
                var pass=$(this).val();
                $.ajax({
                    method: "get",
                    url: 'ajax/kiemtramatkhaucu',
                    data: {
                        pass:pass,
                    },
                    success: function (data) {
                        if(data!=null) {
                            $(".ketqua").html(data);
                        }
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $(".form-group a").click(function(){
                var $this=$(this);
                if(!$this.hasClass('active')){
                    $this.parents(".form-group").find('input').attr('type','text')
                    $this.addClass('active');
                }else{
                    $this.parents(".form-group").find('input').attr('type','password')
                    $this.removeClass('active')
                }
            });
        });
    </script>
@endsection
