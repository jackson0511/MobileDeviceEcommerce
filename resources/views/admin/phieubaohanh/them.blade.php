@extends('admin.layouts.index')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Phiếu bảo hành</h4>
            <ol class="breadcrumb">
                <li><a href="admin/trangchu">Trang chủ</a></li>
                <li><a href="admin/phieubaohanh/danhsach">Phiếu bảo hành</a></li>
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
                <form action="admin/phieubaohanh/them" method="post" data-parsley-validate novalidate>
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-lg-6">
                            <h2>Thông tin sản phẩm</h2>
                            <div class="form-group">
                                <label for="userName">IMEI *</label>
                                <input type="text" name="imei" parsley-trigger="change"   placeholder="Nhập imei sản phẩm" value="{{ old('imei') }}" class="form-control">
                                <p class="text-danger" id="ketqua_check"></p>
                                <button class="ladda-button  btn btn-default" name="check" type="button" data-style="slide-left"><span class="ladda-label">check
                                        </span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 0px;"></div></button>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Sản Phẩm *</label>
                                <select class="form-control" disabled name="tensanpham" id="tensanpham">
                                    <option value="-1">--Chọn sản phẩm--</option>
                                    @foreach($danhmucsanpham as $dmsp)
                                        <option value="{{$dmsp->id}}">{{$dmsp->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="userName">Tình trạng *</label>
                                <textarea name="tinhtrang" class="form-control" id="" cols="30" rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Thời gian *</label>
                                    <div class="input-daterange input-group" id="date-range">
                                        <span class="input-group-addon bg-custom b-0 text-white">Ngày nhận</span>
                                        <input type="text" class="form-control" placeholder="ngày nhận" name="ngaynhan">
                                        <span class="input-group-addon bg-custom b-0 text-white">Ngày trả</span>
                                        <input type="text" class="form-control" placeholder="ngày dự kiến trả" name="ngaytra">
                                    </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Dich vụ *</label>
                                <select disabled class="form-control" name="dichvu[]" id="dichvu" multiple>

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h2>Thông tin khách hàng</h2>
                            <div class="form-group">
                                <label for="userName">Họ tên</label>
                                <input type="text" name="hoten" parsley-trigger="change"   placeholder="Nhập họ tên" value="{{ old('ten') }}" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="userName">Số điện thoại</label>
                                <input type="text" name="sdt" parsley-trigger="change"   placeholder="Nhập số điện thoại" value="{{ old('sdt') }}" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="userName">Địa chỉ</label>
                                <input type="text" name="diachi" parsley-trigger="change"   placeholder="Nhập địa chỉ" value="{{ old('diachi') }}" class="form-control" >
                            </div>
                        </div>
                        <div class="col-lg-12 ketqua_dichvu" style="display: none">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Yêu cầu sửa chữa</th>
                                    <th>Loại dịch vụ</th>
                                    <th>Giá tiền</th>
                                </tr>
                                </thead>
                                <tbody id="ketqua">

                                </tbody>
                            </table>
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
        $("#tensanpham").select2({
            placeholder: "Select a category",
            allowClear: true
        });
        $("#dichvu").select2({
            placeholder: "Select a service",
            allowClear: true
        });
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //animation
            var check = $('.ladda-button').ladda();
            check.click(function () {
                var imei=$("[name=imei]").val();
                check.ladda('start');
                $.ajax({
                    method: "POST",
                    url: 'admin/phieubaohanh/ajax_check_imei',
                    data: {
                        imei:imei,
                    },
                    success: function (data) {
                        if(data!=null) {
                            if (data == 1) {
                                $("#ketqua_check").html('Imei không chính xác');
                                $("#dichvu").prop('disabled', true);
                                $("#tensanpham").prop('disabled', true);
                            }else{
                                $("#dichvu").removeAttr('disabled');
                                $("#tensanpham").removeAttr('disabled');
                                $("#ketqua_check").html('');
                            }
                        }
                      check.ladda('stop');
                    }
                });
            });
            $("#tensanpham").change(function () {
                var id=$(this).val();
                $.ajax({
                    method: "POST",
                    url: 'admin/phieubaohanh/ajax_dichvu',
                    data: {
                        id:id,
                    },
                    success: function (data) {
                        if(data!=null) {
                            $("#dichvu").html(data);
                        }
                    }
                });
            });
            $("#dichvu").change(function () {
                var id=$(this).val();
                var imei=$("[name=imei]").val();
                // if (id!=null) {
                    $.ajax({
                        method: "POST",
                        url: 'admin/phieubaohanh/ajax_tinhphi',
                        data: {
                            id:id,
                            imei:imei,

                        },
                        success: function (data) {
                            if(data!=null) {
                                if (data=='error'){
                                    $(".ketqua_dichvu").css('display','none');
                                }else {
                                    $("#ketqua").html(data);
                                    $(".ketqua_dichvu").css('display', 'block');
                                    //update service
                                    var id_linhkien = -1;
                                    var gia_parent = '';
                                    var gia_child = '';
                                    $(".loaidichvu").change(function () {
                                        var loaidichvu = $(this).val();
                                        id_linhkien = $(this).attr('data-key');
                                        gia_parent = '#gia_parent' + id_linhkien;
                                        gia_child = '#gia_child' + id_linhkien;
                                        // var gia = $("#ketqua").find(gia_child).attr('data-gia');
                                        // var sum = $("#ketqua").find('#sum-parent > #sum-child').attr('data-sum');
                                        var gia_new = $("#ketqua").find(gia_child);
                                        var sum_new = $("#ketqua").find('#sum-parent > #sum-child');
                                        $.ajax({
                                            method: "POST",
                                            url: 'admin/phieubaohanh/ajax_update_dichvu',
                                            data: {
                                                id: loaidichvu,
                                            },
                                            success: function (data) {
                                                if (data != null) {
                                                    var data1=JSON.parse(data);
                                                    gia_new.html(parseInt(data1.gia).toLocaleString() + 'đ');
                                                    sum_new.html(parseInt(data1.sum).toLocaleString() + 'đ');
                                                }
                                            }
                                        });
                                    });
                                }
                            }else{
                                $(".ketqua_dichvu").css('display','none');
                            }
                        }
                    });
                // }
            });
        });
    </script>
@endsection
