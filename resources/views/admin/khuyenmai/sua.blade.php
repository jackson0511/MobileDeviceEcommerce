@extends('admin.layouts.index')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Khuyến mãi</h4>
            <ol class="breadcrumb">
                <li><a href="admin/trangchu">Trang chủ</a></li>
                <li><a href="admin/khuyen mai/danhsach">Khuyến mãi</a></li>
                <li class="active">Sửa</li>
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

                    <form action="admin/khuyenmai/sua/{{$khuyenmai->id}}" method="post" data-parsley-validate novalidate enctype="multipart/form-data" >
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="userName">Tên</label>
                            <input type="text" name="ten" parsley-trigger="change"   placeholder="Nhập tên khuyến mãi" value="{{ $khuyenmai->Ten }}" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label >Hình</label>
                            <input type="file" name="hinh" class="filestyle" data-buttonbefore="true">
                            <br>
                            <img style="width: 150px" src="upload/khuyenmai/{{$khuyenmai->Hinh}}" alt="">
                        </div>
                        <div class="form-group">
                            <label>Ngày Bắt Đầu</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="ngaybatdau" value="{{ date('m/d/Y',strtotime($khuyenmai->NgayBatDau))}}" placeholder="mm/dd/yyyy" id="datepicker">
                                <span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Ngày Kết Thúc</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="ngayketthuc" value="{{ date('m/d/Y',strtotime($khuyenmai->NgayKetThuc))}}" placeholder="mm/dd/yyyy" id="datepicker-autoclose">
                                <span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea name="noidung" class="form-control " id="editor1">
                            {{ $khuyenmai->NoiDung }}
                        </textarea>
                        </div>
                        <div class="form-group">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Chọn</th>
                                    <th>Sản phẩm</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sanpham as $sp)
                                    <tr align="center">
                                        <td>
                                            <input
                                                @foreach($khuyenmai->chitietkhuyenmai as $ct)
                                                type="checkbox"  name="sanpham[]"
                                                @if($ct->idSP==$sp->id)
                                                    {{'checked'}}
                                                @endif
                                                value="{{$sp->id}}"
                                                @endforeach
                                            >
                                        </td>
                                        <td>
                                            <div>{{$sp->id}}-{{$sp->Ten}}</div>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <label for="userName">Chi tiết khuyến mãi</label>
                                <input
                                    @foreach($khuyenmai->chitietkhuyenmai as $ct)
                                        type="text" name="chitiet" parsley-trigger="change"    placeholder="Nhập chi tiết khuyến mãi"
                                       value="{{ $ct->ChiTiet }}" class="form-control"
                                    @endforeach
                                >
                        </div>
                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <div class="radio radio-custom radio-inline">
                                <input
                                    @if($khuyenmai->TrangThai==1)
                                    {{'checked'}}
                                    @endif
                                    type="radio" id="inlineRadio1" value="1" name="trangthai" checked="">
                                <label for="inlineRadio1"> Hiện </label>
                            </div>
                            <div class="radio radio-custom radio-inline">
                                <input
                                    @if($khuyenmai->TrangThai==0)
                                    {{'checked'}}
                                    @endif
                                    type="radio" id="inlineRadio2" value="0" name="trangthai">
                                <label for="inlineRadio2"> Ẩn </label>
                            </div>
                        </div>

                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary waves-effect waves-light" type="submit">
                                Save
                            </button>
                            <button type="reset" class="btn btn-default waves-effect waves-light m-l-5 button">
                                <a href="admin/khuyenmai/danhsach">
                                    Cancel
                                </a>
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
