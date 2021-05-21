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
                <!-- filter -->
                <div class="row" style="margin-bottom: 20px">
                    <div class="col-md-12 p-0">
                        <form class="form-inline" action="admin/phieubaohanh/danhsach" method="post" id=form_search >
                            {{csrf_field()}}
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Tìm kiếm</label>
                                    <input type="text" class="form-control" name="keyword" value="{{ isset($keyword)?$keyword:'' }}" placeholder="nhập imei để tìm">
                                </div>
                                <button  class="btn btn-default" id="search">Tìm</button>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Thời gian</label>
                                    <input class="form-control  input-daterange-datepicker" value="{{ isset($date)?$date:''}}" type="text" name="date" >
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end filter-->
                <table id="datatable" class="table table-bordered table-hover">
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
                    <tbody id="ketqua">
                    @foreach($phieubaohanh as $key => $pbh)
                        <tr align="center" >
                            <td>{{$key+1}}</td>
                            <td>{{$pbh->TenSanPham}}</td>
                            <td >{{$pbh->IMEI}}</td>
                            <td width="150px">{{$pbh->TinhTrang}}</td>
                            <td>{{ number_format($pbh->TongTien,0).'đ'}}</td>
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
                                        @if($pbh->TrangThai!=5 && $pbh->TrangThai!=2)
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
    <div id="loading" style="display: none">
        <img src="images/loading.gif"  alt="">
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
            // show_list();
            function show_list() {
                $.ajax({
                    method: "POST",
                    url: 'admin/phieubaohanh/show_list',
                    dataType : 'json',
                    success: function (response) {
                        var html='';
                        var data='';
                        var trangthai_class='';
                        var trangthai='';
                        var option='';
                        $.each(response,function (key,value) {
                            if (value.NgayHenLai!=null){
                                data='Ngày hẹn lại: '+'<br>'+value.NgayHenLai+'<br>'+'('+value.GhiChu+')';
                            }else{
                                data='';
                            }
                            if(value.TrangThai==0 || value.TrangThai==2){
                                trangthai_class='btn-danger';
                            }else if(value.TrangThai==3){
                                trangthai_class='btn-inverse waves-effect waves-light';
                            }else{
                                trangthai_class='btn-default';
                            }
                            if(value.TrangThai==1){
                                trangthai='Đang xử lý';
                            }else if(value.TrangThai==2){
                                trangthai='Khách không sửa';
                            }else if(value.TrangThai==3){
                                trangthai='Chuyển về trung tâm';
                            }else if(value.TrangThai==4){
                                trangthai='Trung tâm trả máy';
                            }else if(value.TrangThai==5){
                                trangthai='Hoàn thành';
                            }else{
                                trangthai='Chờ xử lý ';
                            }
                            if(value.TrangThai==0){
                                option+='<li><a href="admin/phieubaohanh/sua/'+value.id+'"><i class="fa fa-pencil m-r-10"></i>Sửa</a></li>';
                            } if(value.TrangThai==0 || value.TrangThai==1){
                                option+='<li><a class="chuyentrungtam" data-key="'+value.id+'" href="javascript:void(0)"><i class="md md-forward m-r-10"></i>Chuyển về trung tâm</a></li>';
                            } if(value.TrangThai==0 || value.TrangThai==1 || value.TrangThai==4){
                                option+='<li><a href="admin/phieubaohanh/update-status/'+value.id+'"><i class="md md-forward m-r-10"></i>Chuyển trạng thái</a></li>';
                            } if(value.TrangThai!=5 && value.TrangThai!=2){
                                option+=' <li><a class="henlai" data-key="'+value.id+'" href="javascript:void(0)"><i class="md md-forward m-r-10"></i>Hẹn lại</a></li>';
                            }

                            html+='<tr align="center">' +
                                '<td>'+ ++key +'</td>' +
                                '<td>'+value.TenSanPham+'</td>'+
                                '<td>'+value.IMEI+'</td>' +
                                '<td  width="150px">'+value.TinhTrang+'</td>' +
                                '<td>'+new Intl.NumberFormat().format(value.TongTien)+'đ'+'</td>' +
                                '<td  width="200px">'+
                                'Họ tên: ' +value.HoTen+'<br>'+
                                'Số điện thoại: '+value.SoDienThoai+'<br>'+
                                'Địa chỉ: '  +value.DiaChi+
                                '</td>' +
                                '<td width="150px">'+
                                'Ngày nhận: '+'<br>' +value.NgayNhan+'<br>'+
                                'Ngày trả: '+'<br>'+value.NgayTraDuKien+'<br>'+
                                data +
                                '</td>' +
                                '<td>'+
                                '<a class="btn btn-xs '+trangthai_class+'">'+
                                trangthai  +
                                '</a>'+
                                '</td>' +
                                '<td>'+
                                '<ul class="nav navbar-nav ">\n' +
                                '        <li class="dropdown navbar-c-items">\n' +
                                '           <a href="" class="dropdown-toggle waves-effect waves-light profile" data-toggle="dropdown" aria-expanded="true"><i class="md md-settings"></i> </a>\n'+
                                '             <ul class="dropdown-menu" style="min-width: 100px; right: 0;left: unset">'+
                                '               <li><a href="javascript:void(0)" class="view" data-key="'+value.id+'"><i class="fa fa-eye m-r-10"></i>Chi tiết</a></li>'+
                                            option
                                '             </ul>'
                            '         </li>'
                            '      </ul>'
                            '</td>' +
                            '</tr> ';
                        });
                        $("#ketqua").html(html);

                    }
                });
            }
            $('[name="date"]').change(function () {
                $("#form_search").submit();
            });
            $("#datatable").on('click','.view',function () {
                $("#loading").show();
                var id=$(this).attr('data-key');
                setTimeout(function() {
                    $("#modal").modal('show');
                    $(".idbaohanh").text(id);
                }, 500);
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
                        setTimeout(function() {
                            $("#loading").hide();
                        }, 500);
                    }
                });
            });
            $("#datatable").on('click','.chuyentrungtam',function () {
                var id=$(this).attr('data-key');
                $("#modal-chuyentrungtam").modal('show');
                $(".id_edit").val(id);
            });
            $("#modal-chuyentrungtam").on('click','.baohanh_chuyentrungtam',function () {
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
                            show_list();
                        }
                    });
                }else{
                    $(".error").text('vui lòng nhập đầy đủ thông tin')
                }
            });
            $("#datatable").on('click','.henlai',function () {
                var id=$(this).attr('data-key');
                $("#modal-henlai").modal('show');
                $(".id_edit_henlai").val(id);
            });
            $("#modal-henlai").on('click','.baohanh_henlai',function () {
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
                            show_list();
                        }
                    });
                }else{
                    $(".error").text('vui lòng nhập đầy đủ thông tin');
                }
            });
        });
    </script>
@endsection
