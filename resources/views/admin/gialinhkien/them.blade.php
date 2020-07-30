@extends('admin.layouts.index')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Giá linh kiện</h4>
            <ol class="breadcrumb">
                <li><a href="admin/trangchu">Trang chủ</a></li>
                <li><a href="admin/gialinhkien/danhsach">Giá linh kiện</a></li>
                <li class="active">Thêm</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
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

                <form action="admin/gialinhkien/them" method="post" data-parsley-validate novalidate>
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="userName">Tên linh kiện</label>
                        <input type="text" name="ten" parsley-trigger="change"   placeholder="Nhập tên linh kiện" value="{{ old('ten') }}" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="userName">Giá</label>
                        <input type="text" name="gia" parsley-trigger="change"   placeholder="Nhập giá" value="{{ old('gia') }}" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="userName">Số lượng</label>
                        <input type="text" name="soluong" parsley-trigger="change"   placeholder="Nhập số lượng" value="{{ old('soluong') }}" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Sản Phẩm</label>
                        <select class="form-control" name="danhmucsanpham" id="danhmucsanpham">
                            <option value="-1">--Chọn sản phẩm--</option>
                            @foreach($danhmucsanpham as $dmsp)
                                <option value="{{$dmsp->id}}">{{$dmsp->Ten}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Trạng thái</label>
                        <div class="radio radio-custom radio-inline">
                            <input type="radio" id="inlineRadio1" value="1" name="trangthai" checked="">
                            <label for="inlineRadio1"> còn hàng </label>
                        </div>
                        <div class="radio radio-custom radio-inline">
                            <input type="radio" id="inlineRadio2" value="0" name="trangthai">
                            <label for="inlineRadio2"> hết hàng </label>
                        </div>
                    </div>
                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary waves-effect waves-light" type="submit">
                            Save
                        </button>
                        <button type="reset" class="btn btn-default waves-effect waves-light m-l-5 button">
                            <a href="admin/gialinhkien/danhsach">Cancel</a>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
@section('script')
    <script>
        $("#danhmucsanpham").select2({
            placeholder: "Select a category",
            allowClear: true
        });
    </script>
@endsection
