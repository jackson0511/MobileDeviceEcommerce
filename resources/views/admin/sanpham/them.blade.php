@extends('admin.layouts.index')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Sản phẩm</h4>
            <ol class="breadcrumb">
                <li><a href="admin/trangchu">Trang chủ</a></li>
                <li><a href="admin/sanpham/danhsach">Sản phẩm</a></li>
                <li class="active">Thêm</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
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

                <form action="admin/sanpham/them" method="post" data-parsley-validate novalidate enctype="multipart/form-data" >
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Thể loại </label>
                                <select class="form-control" name="theloai" id="theloai">
                                    <option value="-1">--Chọn thể loại--</option>
                                    @foreach($theloai as $tl)
                                        <option value="{{$tl->id}}">
                                            {{$tl->parent_id!=null?$tl->parent->Ten:''}}-{{$tl->Ten}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="userName">Tên</label>
                                <input type="text" name="ten" parsley-trigger="change"   placeholder="Nhập tên sản phẩm" value="{{ old('ten') }}" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="userName">Giá</label>
                                <input type="text" name="gia" parsley-trigger="change"   placeholder="Nhập giá sản phẩm" value="{{ old('gia') }}" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="userName">Số lượng</label>
                                <input type="text" name="soluong" parsley-trigger="change"   placeholder="Nhập số lượng sản phẩm" value="{{ old('soluong') }}" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label >Hình</label>
                                <input type="file" name="hinh" class="filestyle" data-buttonbefore="true">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group ">
                                <div class="ketqua"></div>

                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Bộ lọc</label>
                        <select class="form-control" style="height: 200px" name="boloc[]" id="boloc" multiple>
                            @foreach($boloc as $bl)
                                <option
                                    value="{{$bl->id}}">
                                    {{$bl->parent!=null?$bl->parent->Ten:$bl->Ten}}-{{$bl->Ten}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tóm tắt</label>
                        <textarea name="tomtat" class="form-control " id="editor2">
                            {{ old('tomtat') }}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea name="noidung" class="form-control " id="editor1">
                            {{ old('noidung') }}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Bảo hành </label>
                        <select class="form-control" name="baohanh" id="baohanh">
                            <option value="-1">--Chọn bảo hành--</option>
                            @foreach($baohanh as $bh)
                                <option value="{{$bh->id}}">
                                   {{$bh->Ten}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="userName">Type (ví dụ iphone x 64gb->iphone-x,iphone x 256gb->iphone-x ...) </label>
                        <input type="text" name="type" parsley-trigger="change"   placeholder="Nhập type sản phẩm" value="{{ old('type') }}" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="">Trạng thái</label>
                        <div class="radio radio-custom radio-inline">
                            <input type="radio"  value="1" name="trangthai" checked="">
                            <label for="inlineRadio1"> Hiện </label>
                        </div>
                        <div class="radio radio-custom radio-inline">
                            <input type="radio"  value="0" name="trangthai">
                            <label for="inlineRadio2"> Ẩn </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Bán chạy</label>
                        <div class="radio radio-custom radio-inline">
                            <input type="radio"  value="1" name="banchay" checked="">
                            <label for="inlineRadio1"> Có </label>
                        </div>
                        <div class="radio radio-custom radio-inline">
                            <input type="radio"  value="0" name="banchay">
                            <label for="inlineRadio2"> Không </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Tình trạng</label>
                        <div class="radio radio-custom radio-inline">
                            <input type="radio"  value="1" name="tinhtrang" checked="">
                            <label for="inlineRadio1"> Hàng mới </label>
                        </div>
                        <div class="radio radio-custom radio-inline">
                            <input type="radio"  value="2" name="tinhtrang">
                            <label for="inlineRadio2"> Hàng like new </label>
                        </div>
                        <div class="radio radio-custom radio-inline">
                            <input type="radio"  value="3" name="tinhtrang">
                            <label for="inlineRadio2"> Hàng trưng bày </label>
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
        $("#theloai").select2({
            placeholder: "Select a category",
            allowClear: true
        });
        $("#boloc").select2({
            placeholder: "Select a filter",
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
        CKEDITOR.replace( 'editor2', {
            filebrowserBrowseUrl: "admin/ckfinder/ckfinder.html",
            filebrowserImageBrowseUrl: "admin/ckfinder/ckfinder.html?type=Images",
            filebrowserFlashBrowseUrl: "admin/ckfinder/ckfinder.html?type=Flash",
            filebrowserUploadUrl: "admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files",
            filebrowserImageUploadUrl: "admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images",
            filebrowserFlashUploadUrl: "admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash"
        } );
    </script>
    <script>
        jQuery(document).ready(function($) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#theloai').change(function () {
                var id=$(this).val();
                var result=' <label>Thuộc tính</label>' +
                            '<br>';
                $.ajax({
                    method: "POST",
                    url: 'ajax/show-thuoc-tinh',
                    data: {
                        id:id,
                    },
                    success: function (data) {
                        if(data!=null) {
                            $.each(JSON.parse(data),function (k,v) {
                                result+='\n' +
                                    '      <input type="checkbox" class="form-group thuoctinh" name="thuoctinh['+k+']['+v.id+']" value="'+v.id+'">\n'+v.Ten+
                                    '      <div class="form-group giatri">\n' +
                                    '      <input  class="form-control "  name="thuoctinh['+k+']['+v.id+']" placeholder="nhập giá trị thuộc tính " />\n' +
                                    '     </div>';
                            });

                            $(".ketqua").html(result);
                        }
                        $('input.thuoctinh').change(function(){
                            if ($(this).is(':checked'))
                                $(this).next('div.giatri').show();
                            else
                                $(this).next('div.giatri').hide();
                        }).change();
                    }
                });
            });
        });
    </script>

@endsection
