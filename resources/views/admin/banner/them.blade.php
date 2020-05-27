@extends('admin.layouts.index')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Banner</h4>
            <ol class="breadcrumb">
                <li><a href="admin/trangchu">Trang chủ</a></li>
                <li><a href="admin/banner/danhsach">Banner</a></li>
                <li class="active">Thêm</li>
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

                <form action="admin/banner/them" method="post" data-parsley-validate novalidate enctype="multipart/form-data" >
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="userName">Tên</label>
                        <input type="text" name="ten" parsley-trigger="change" required  placeholder="Nhập tên banner" value="{{ old('ten') }}" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea name="noidung" class="form-control " id="editor1">
                            {{ old('noidung') }}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label >Hình</label>
                        <input type="file" name="hinh" class="filestyle" data-buttonbefore="true">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Sản phẩm</label>
                        <select class="form-control" name="sanpham" id="sanpham">
                            @foreach($sanpham as $sp)
                                <option value="{{$sp->id}}">{{$sp->id}}-{{$sp->Ten}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Trạng thái</label>
                        <div class="radio radio-custom radio-inline">
                            <input type="radio" id="inlineRadio1" value="1" name="trangthai" checked="">
                            <label for="inlineRadio1"> Hiện </label>
                        </div>
                        <div class="radio radio-custom radio-inline">
                            <input type="radio" id="inlineRadio2" value="0" name="trangthai">
                            <label for="inlineRadio2"> Ẩn </label>
                        </div>
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
    <script>
        $("#sanpham").select2({
            placeholder: "Select a state",
            allowClear: true
        });
        CKEDITOR.replace( 'editor1', {
            filebrowserBrowseUrl: "admin/ckfinder/ckfinder.html",
            filebrowserImageBrowseUrl: "admin/ckfinder/ckfinder.html?type=Images",
            filebrowserFlashBrowseUrl: "admin/ckfinder/ckfinder.html?type=Flash",
            filebrowserUploadUrl: "admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files",
            filebrowserImageUploadUrl: "admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images",
            filebrowserFlashUploadUrl: "admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash"
        } );
    </script>
@endsection
