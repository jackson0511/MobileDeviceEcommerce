@extends('admin.layouts.index')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <h4 class="page-title">Thể Loại Mã khuyến mãi</h4>
            <ol class="breadcrumb">
                <li><a href="admin/trangchu">Trang chủ</a></li>
                <li><a href="admin/theloaimakhuyenmai/danhsach">Thể Loại Mã khuyến mãi</a></li>
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

                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th width="150px">Tên</th>
                        <th>Code</th>
                        <th>Ngày áp dụng</th>
                        <th>Ngày kết thúc</th>
                        <th>Giá trị</th>
                        <th>Số Lượng</th>
                        <th>Trạng thái</th>
                        <th>Sửa</th>
                        <th>Xoá</th>
                    </tr>
                    </thead>


                    <tbody>
                    @foreach($theloaimakhuyenmai as $makm)
                        <tr align="center" >
                            <td>{{$makm->id}}</td>
                            <td>{{$makm->Ten}}</td>
                            <td>{{$makm->Code}}</td>
                            <td>{{$makm->NgayApDung}}</td>
                            <td>{{$makm->NgayKetThuc}}</td>
                            <td>{{$makm->GiaTri}}</td>
                            <td>{{$makm->SoLuong}}</td>
                            <td>
                                <a href="admin/theloaimakhuyenmai/xuly/{{$makm->id}}" class="btn btn-xs {{$makm->TrangThai==1?'btn-info':'btn-danger'}} ">
                                    {{$makm->TrangThai==1?'Áp dụng':'Không áp dụng'}}
                                </a>
                            </td>
                            <td>
                                <i class="fa fa-pencil">
                                    <a href="admin/theloaimakhuyenmai/sua/{{$makm->id}}">
                                        Sửa
                                    </a>
                                </i>
                            </td>
                            <td>
                                <i class="fa fa-eye view-coupon" data-key="{{$makm->id}}">
                                </i>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">mã khuyến mãi #<b class="idtheloaimakhuyenmai" ></b></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body ">
                    <table class="table table-striped table-bordered table-hover ketqua" id="dataTables-example">

                    </table>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    <div id="loading" style="display: none">
        <img src="images/loading.gif"  alt="">
    </div>
    <!-- end row -->
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.view-coupon').click(function () {
                $("#loading").show();
                var id=$(this).attr("data-key");
                setTimeout(function() {
                    $("#myModal").modal('show');
                    $(".idtheloaimakhuyenmai").text(id);
                }, 500);
                var id=$(this).attr('data-key');
                $.ajax({
                    method: "POST",
                    url: 'ajax/makhuyenmai',
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
        });
    </script>
@endsection
