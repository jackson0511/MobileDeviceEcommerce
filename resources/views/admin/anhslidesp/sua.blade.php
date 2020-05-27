@extends('admin.layouts.index')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Ảnh slide sản phẩm</h4>
            <ol class="breadcrumb">
                <li><a href="admin/trangchu">Trang chủ</a></li>
                <li><a href="admin/anhslidesanpham/danhsach">Ảnh slide sản phẩm</a></li>
                <li class="active">Sửa</li>
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

                    <form action="admin/anhslidesanpham/sua/{{$anhslidesp->id}}" method="post" data-parsley-validate novalidate enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="userName">Ảnh trên</label>
                            <input type="file" name="anhtren" class="filestyle" data-buttonbefore="true" value="{{$anhslidesp->AnhTren}}">
                            <br>
                            <img src="upload/anhslidesp/{{$anhslidesp->AnhTren}}" width="100px" alt="">
                        </div>
                        <div class="form-group">
                            <label for="userName">Ảnh dưới</label>
                            <input type="file" name="anhduoi" class="filestyle" data-buttonbefore="true" value="{{$anhslidesp->AnhDuoi}}">
                            <br>
                            <img src="upload/anhslidesp/{{$anhslidesp->AnhDuoi}}" width="100px" alt="">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Sản phẩm</label>
                            <select class="form-control" name="sanpham" id="sanpham">
                                @foreach($sanpham as $sp)
                                    <option
                                        @if($sp->id==$anhslidesp->idSP)
                                            {{'selected'}}
                                        @endif
                                        value="{{$sp->id}}">{{$sp->id}}-{{$sp->Ten}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary waves-effect waves-light" type="submit">
                                Save
                            </button>
                            <button type="reset" class="btn btn-default waves-effect waves-light m-l-5">
                                Cancel
                            </button>
                        </div>

                    </form>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
@section('script')
    <script >
        $("#sanpham").select2({
            placeholder: "Select a state",
            allowClear: true
        });
    </script>
@endsection
