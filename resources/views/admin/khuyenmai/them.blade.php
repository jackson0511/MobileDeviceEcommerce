@extends('admin.layouts.index')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Khuyến mãi</h4>
            <ol class="breadcrumb">
                <li><a href="admin/trangchu">Trang chủ</a></li>
                <li><a href="admin/khuyen mai/danhsach">Khuyến mãi</a></li>
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

                <form action="admin/khuyenmai/them" method="post" data-parsley-validate novalidate enctype="multipart/form-data" >
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="userName">Tên</label>
                        <input type="text" name="ten" parsley-trigger="change"   placeholder="Nhập tên khuyến mãi" value="{{ old('ten') }}" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label >Hình</label>
                        <input type="file" name="hinh" class="filestyle" data-buttonbefore="true">
                    </div>
                    <div class="form-group">
                        <label>Ngày Hiệu Lực</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="ngayhieuluc" data-date="{{date('d/m/Y',strtotime($ngay))}}" value="{{old('ngayhieuluc')}}" id="ngayhieuluc">
                            <span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea name="noidung" class="form-control " id="editor1">
                            {{ old('noidung') }}
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
                                            <input type="checkbox"  name="sanpham[]" value="{{$sp->id}}">
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
                        <label for="">Khuyến mãi</label>
                        <div class="radio radio-custom radio-inline">
                            <input type="radio" id="inlineRadio1" value="1" name="khuyenmai" checked="">
                            <label for="inlineRadio1"> Phần trăm giảm giá </label>
                        </div>
                        <div class="radio radio-custom radio-inline">
                            <input type="radio" id="inlineRadio2" value="2" name="khuyenmai">
                            <label for="inlineRadio2"> Tặng sản phẩm </label>
                        </div>
                    </div>
                    <!-- tang san pham -->
                    <div class="form-group sanpham_sale" style="display: none">
                        <label for="exampleFormControlSelect1">Chi tiết khuyến mãi</label>
                        <select class="form-control" name="chitiet_sp" id="sanpham">
                            <option value="-1">--Chọn sản phẩm--</option>
                            @foreach($sanpham as $sp)
                                <option value="{{$sp->id}}">{{$sp->Ten}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- phan tram giam gia -->
                    <div class="form-group phantram" style="display: none">
                        <label for="userName">Chi tiết khuyến mãi</label>
                        <input
                            type="text" name="chitiet_km" parsley-trigger="change"      placeholder="Nhập chi tiết khuyến mãi"
                            value="" class="form-control"
                        >
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
        $(document).ready(function () {
            var checked = $("[name='khuyenmai']:checked").val();
            if(checked==1){
                $(".phantram").css('display','block');
            }else{
                $(".sanpham_sale").css('display','block');
            }
            $("[name='khuyenmai']").click(function () {
                var radioValue = $(this).val();
                if ( radioValue==1){
                    $(".phantram").css('display','block');
                    $(".sanpham_sale").css('display','none');
                }else {
                    $(".sanpham_sale").css('display','block');
                    $(".phantram").css('display','none');
                }
            });
        });
        var dt_daterangepicker = () => {
            max_date=$("#ngayhieuluc").attr('data-date');
            $('input[name="ngayhieuluc"]').daterangepicker({
                opens: 'top',
                isInvalidDate: false,
                minDate:max_date,
                "locale": {
                    "format": "DD/MM/YYYY",
                },
            });
        };
        dt_daterangepicker();
    </script>

@endsection
