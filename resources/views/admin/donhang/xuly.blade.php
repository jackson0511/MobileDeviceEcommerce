@extends('admin.layouts.index')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <h4 class="page-title">Chi tiết đơn hàng</h4>
            <ol class="breadcrumb">
                <li><a href="admin/trangchu">Trang chủ</a></li>
                <li><a >Chi tiết đơn hàng</a></li>
                <li class="active">Xử lý</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10">
            <div class="card-box">

                <p class="text-muted font-13 m-b-30">
                @if(count($errors)>0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                            {{$err}}
                            <br>
                        @endforeach
                    </div>
                    @endif
                    </p>

                    <form action="admin/donhang/xuly/{{$ctdh->id}}" method="post" data-parsley-validate novalidate>
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="userName">Tên</label>
                            <input type="text" name="ten" parsley-trigger="change" readonly  value="{{ $ctdh->sanpham->Ten }}" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="userName">Số lượng</label>
                            <input type="text" name="soluong" parsley-trigger="change" readonly  value="{{ $ctdh->SoLuong }}" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="userName">Giá</label>
                            <input type="text" name="gia" parsley-trigger="change"  readonly value="{{ $ctdh->Gia }}" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="userName">Hình</label>
                            <input type="text" name="hinh" parsley-trigger="change" readonly  value="{{ $ctdh->sanpham->Hinh }}" class="form-control" >
                            <img width="150px" src="upload/sanpham/{{$ctdh->sanpham->Hinh }}" alt="">
                        </div>
                        <div class="form-group">
                            <label for="userName">IMEI</label>
                            <input type="imei" name="imei" parsley-trigger="change"  placeholder="nhập imei sản phẩm" class="form-control" >
                        </div>
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary waves-effect waves-light" type="submit">
                                Save
                            </button>
                            <button type="reset" class="btn btn-default waves-effect waves-light m-l-5 button">
                                <a href="admin/donhang/danhsach">Cancel</a>
                            </button>
                        </div>

                    </form>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
