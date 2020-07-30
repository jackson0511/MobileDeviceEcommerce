@extends('admin.layouts.index')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <h4 class="page-title">Phiếu bảo hành</h4>
            <ol class="breadcrumb">
                <li><a href="admin/trangchu">Trang chủ</a></li>
                <li><a href="admin/phieubaohanh/danhsach">Phiếu bảo hành</a></li>
                <li class="active">Danh sách</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">

            @if(session('ThongBao'))
                <div class="alert alert-info">
                    {{session('ThongBao')}}
                </div>
            @endif

            <div class="card-box table-responsive">
                <table id="datatable" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>IMEI</th>
                        <th>Tình trạng</th>
                        <th>Tổng tiền</th>
                        <th>Khách hàng</th>
                        <th>Thời gian</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($phieubaohanh as $key => $pbh)
                        <tr align="center" >
                            <td>{{$key+1}}</td>
                            <td>{{$pbh->TenSanPham}}</td>
                            <td >{{$pbh->IMEI}}</td>
                            <td width="150px">{{$pbh->TinhTrang}}</td>
                            <td>{{ number_format($pbh->TongTien,0,',','.').'đ'}}</td>
                            <td width="200px">
                                {{
                                    'Họ tên: '.$pbh->HoTen
                                 }}
                                <br>
                                {{'Số điện thoại: '.$pbh->SoDienThoai}}
                                <br>
                                {{
                                'Địa chỉ: '.$pbh->DiaChi
                                }}
                            </td>
                            <td width="150px">
                                {{"Ngày nhận: "}}<br>{{$pbh->NgayNhan}}
                                <br>
                                {{"Ngày trả: "}}<br>{{$pbh->NgayTraDuKien}}
                                <br>
                                @if($pbh->NgayHenLai!=null)
                                    {{"Ngày hẹn lại: "}}<br>{{$pbh->NgayHenLai}}
                                    <br>
                                    {{'('.$pbh->GhiChu.')'}}
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-xs
                                    @if($pbh->TrangThai==0 || $pbh->TrangThai==2)
                                        {{'btn-danger'}}
                                    @elseif($pbh->TrangThai==3)
                                        {{'btn-inverse waves-effect waves-light'}}
                                    @else
                                        {{'btn-default'}}
                                    @endif
                                    ">
                                    @if($pbh->TrangThai==1)
                                        {{'Đang xử lý'}}
                                    @elseif($pbh->TrangThai==2)
                                        {{'Khách không sửa'}}
                                    @elseif($pbh->TrangThai==3)
                                        {{'Chuyển về trung tâm'}}
                                    @elseif($pbh->TrangThai==4)
                                        {{'Trung tâm trả máy'}}
                                    @elseif($pbh->TrangThai==5)
                                        {{'Hoàn thành'}}
                                    @else
                                        {{'Chờ xử lý '}}
                                    @endif

                                </a>
                            </td>
                            <td>
                                <ul class="nav navbar-nav ">
                                <li class="dropdown navbar-c-items">
                                    <a href="" class="dropdown-toggle waves-effect waves-light profile" data-toggle="dropdown" aria-expanded="true"><i class="md md-settings"></i> </a>
                                    <ul class="dropdown-menu" style="min-width: 100px; right: 0;left: unset">
                                        <li><a href="javascript:void(0)" class="view" data-key="{{$pbh->id}}"><i class="fa fa-eye m-r-10"></i>Chi tiết </a></li>
                                        @if($pbh->TrangThai==0 )
                                            <li><a href="admin/phieubaohanh/sua/{{$pbh->id}}"><i class="fa fa-pencil m-r-10"></i>Sửa</a></li>
                                        @endif
                                        @if($pbh->TrangThai==0 || $pbh->TrangThai==1)
                                            <li><a class="chuyentrungtam" data-key="{{$pbh->id}}" href="javascript:void(0)"><i class="md md-forward m-r-10"></i>Chuyển về trung tâm</a></li>
                                        @endif
                                        @if($pbh->TrangThai==0 ||  $pbh->TrangThai==1 ||  $pbh->TrangThai==4)
                                        <li><a href="admin/phieubaohanh/update-status/{{$pbh->id}}"><i class="md md-forward m-r-10"></i>Chuyển trạng thái</a></li>
                                        @endif
                                        @if($pbh->TrangThai!=5)
                                            <li><a class="henlai" data-key="{{$pbh->id}}" href="javascript:void(0)"><i class="md md-forward m-r-10"></i>Hẹn lại</a></li>
                                        @endif
                                    </ul>
                                </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="container">
        <div id="modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="full-width-modalLabel">Chi tiết phiếu bảo hành #<b class="idbaohanh" ></b></h4>
                    </div>
                    <div class="modal-body ketqua">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- /.chuyen trung tam -->
        <div id="modal-chuyentrungtam" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="full-width-modalLabel">Nhập thông tin chuyển</h4>
                    </div>
                    <div class="modal-body">
                        <p class="text-danger error"></p>
                        <div class="form-group">
                            <label>Ngày nhận</label>
                            <div class="input-group">
                                <input type="text" class="form-control ngaygui" name="ngaygui"  placeholder="mm/dd/yyyy" id="datepicker">
                                <span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Ngày trả</label>
                            <div class="input-group">
                                <input type="text" class="form-control ngaytra" name="ngaytra"  placeholder="mm/dd/yyyy" id="datepicker-autoclose">
                                <span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
                            </div>
                        </div>
                        <input type="hidden" name="phieubaohanh_id" class="id_edit">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect baohanh_chuyentrungtam">Submit</button>
                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- /.hen lai-->
        <div id="modal-henlai" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="full-width-modalLabel">Nhập thời gian hẹn lại</h4>
                    </div>
                    <div class="modal-body">
                        <p class="text-danger error"></p>
                        <div class="form-group">
                            <label>Ngày trả mới</label>
                            <div class="input-group">
                                <input type="date" class="form-control ngaytra_moi" name="ngaytra_moi"  placeholder="mm/dd/yyyy" >
                                <span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Ghi chú</label>
                            <div class="input-group">
                                <textarea name="ghichi" class="form-control ghichu" cols="60" rows="10"></textarea>
                            </div>
                        </div>
                        <input type="hidden" name="phieubaohanh_id" class="id_edit_henlai">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect baohanh_henlai">Submit</button>
                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
    <!-- end row -->
@endsection
@section('script')
    <script >
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(".view").click(function () {
                var id=$(this).attr('data-key');
                $("#modal").modal('show');
                $(".idbaohanh").text(id);
                $.ajax({
                    method: "POST",
                    url: 'admin/phieubaohanh/show_chitiet_baohanh',
                    data: {
                        id:id,
                    },
                    success: function (data) {
                        if(data!=null) {
                            $(".ketqua").html(data);
                        }
                    }
                });
            });
            $(".chuyentrungtam").click(function () {
                var id=$(this).attr('data-key');
                $("#modal-chuyentrungtam").modal('show');
                $(".id_edit").val(id);
            });
            $(".baohanh_chuyentrungtam").click(function () {
                var ngaygui=$('.ngaygui').val();
                var ngaytra=$('.ngaytra').val();
                var id=$(".id_edit").val();
                if(ngaygui!='' && ngaytra!='') {
                    $.ajax({
                        method: "POST",
                        url: 'admin/phieubaohanh/chuyentrungtam',
                        data: {
                            ngaygui: ngaygui,
                            ngaytra: ngaytra,
                            id: id
                        },
                        success: function () {
                            $('#modal-chuyentrungtam').modal('hide');
                            $('.ngaygui').val("");
                            $('.ngaytra').val("");
                            // location.reload();
                        }
                    });
                }else{
                    $(".error").text('vui lòng nhập đầy đủ thông tin');
                }
            });
            $(".henlai").click(function () {
                var id=$(this).attr('data-key');
                $("#modal-henlai").modal('show');
                $(".id_edit_henlai").val(id);
            });
            $(".baohanh_henlai").click(function () {
                var ngaytra=$(".ngaytra_moi").val();
                var ghichu=$(".ghichu").val();
                var id=$(".id_edit_henlai").val();
                if(ngaytra!='' && ghichu!='') {
                    $.ajax({
                        method: "POST",
                        url: 'admin/phieubaohanh/henlai',
                        data: {
                            ngaytra: ngaytra,
                            ghichu:ghichu,
                            id: id
                        },
                        success: function () {
                            $('#modal-henlai').modal('hide');
                            $('.ghichu').val("");
                            $('.ngaytra_moi').val("");
                            // location.reload();
                        }
                    });
                }else{
                    $(".error").text('vui lòng nhập đầy đủ thông tin');
                }
            });
        });
    </script>
@endsection
