@extends('admin.layouts.index')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <h4 class="page-title">Khuyến mãi</h4>
            <ol class="breadcrumb">
                <li><a href="admin/trangchu">Trang chủ</a></li>
                <li><a href="admin/khuyenmai/danhsach">Khuyến mãi</a></li>
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
                        <th width="190px">Tên</th>
                        <th>Hình</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày kết thúc</th>
                        <th>Quản trị</th>
                        <th>Trạng thái</th>
                        <th>Sửa</th>
                        <th>View</th>
                    </tr>
                    </thead>


                    <tbody>
                    @foreach($khuyenmai as $km)
                        <tr align="center" >
                            <td>{{$km->id}}</td>
                            <td>{{$km->Ten}}</td>
                            <td>
                                <img width="150px" src="upload/khuyenmai/{{$km->Hinh}}" alt="{{$km->Hinh}}">
                            </td>
                            <td>{{$km->NgayBatDau}}</td>
                            <td>{{$km->NgayKetThuc}}</td>
                            <td>{{$km->quantri->HoTen}}</td>
                            <td>
                                <a class="btn btn-xs {{$km->TrangThai==1?'btn-info':'btn-danger'}}">
                                    {{$km->TrangThai==1?'Hiển thị':'Ẩn'}}
                                </a>
                            </td>
                            <td>
                                <i class="fa fa-pencil">
                                    <a href="admin/khuyenmai/sua/{{$km->id}}">
                                        Sửa
                                    </a>
                                </i>
                            </td>
                            <td>
                                <a class="view" data-key="{{$km->id}}">
                                    <i class="fa fa-eye"></i>
                                </a>
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
                    <h4 class="modal-title">Chi tiết khuyến mãi #<b class="idkhuyenmai" ></b></h4>
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
    <!-- end row -->
@endsection
@section('script')
    <script type="text/javascript">
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(".view").click(function(){
                var id=$(this).attr("data-key");
                $("#myModal").modal('show');
                $(".idkhuyenmai").text(id);

                $.ajax({
                    method: "POST",
                    url: 'ajax/chitietkhuyenmai',
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
        });
    </script>
@endsection
