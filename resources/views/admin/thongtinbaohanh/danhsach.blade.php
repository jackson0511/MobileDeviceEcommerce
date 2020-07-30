@extends('admin.layouts.index')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <h4 class="page-title">Thông tin Bảo hành</h4>
            <ol class="breadcrumb">
                <li><a href="admin/trangchu">Trang chủ</a></li>
                <li><a href="admin/thongtinbaohanh/danhsach">Thông tin Bảo hành</a></li>
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
                <div class="row">
                    <div class="col-md-12 p-0  text-center">
                        <form class="form-inline" action="admin/thongtinbaohanh/danhsach" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Tìm kiếm</label>
                                <input type="text" class="form-control" name="keyword" placeholder="nhập imei để tìm">
                            </div>
                            <button class="btn btn-default">Tìm</button>
                        </form>
                    </div>
                </div>
                <!-- end filtet-->
                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>IMEI</th>
                        <th>Thời gian</th>
                        <th>Ngày Áp Dụng</th>
                        <th>Ngày kết Thúc</th>
                        <th>Trạng thái</th>
{{--                        <th>Sửa</th>--}}
                        <th>Option</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($thongtinbaohanh as $key => $ttbh)
                        <tr align="center" >
                            <td>{{$key+1}}</td>
                            <td>{{$ttbh->sanpham->Ten}}</td>
                            <td>{{$ttbh->sanpham->Gia}}</td>
                            <td>{{$ttbh->IMEI}}</td>
                            <td>{{$ttbh->BaoHanh}}</td>
                            <td>{{$ttbh->NgayApDung}}</td>
                            <td>{{$ttbh->NgayKetThuc}}</td>
                            <td>
                                <a class="btn btn-xs {{$ttbh->TrangThai==1?'btn-danger':'btn-info'}} ">
                                    {{$ttbh->TrangThai==1?'Hết bảo hành':'Còn bảo hành'}}
                                </a>
                            </td>
{{--                            <td>--}}
{{--                                <i class="fa fa-pencil">--}}
{{--                                    <a href="admin/thongtinbaohanh/sua/{{$ttbh->id}}">--}}
{{--                                        Sửa--}}
{{--                                    </a>--}}
{{--                                </i>--}}
{{--                            </td>--}}
                            <td>
                                <a class="view" data-key="{{$ttbh->id}}">
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
                    <h4 class="modal-title">option bảo hành #<b class="idbaohanh" ></b></h4>
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
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(".view").click(function () {
                var id=$(this).attr('data-key');
                $("#myModal").modal('show');
                $(".idbaohanh").text(id);
                $.ajax({
                    method: "POST",
                    url: 'admin/thongtinbaohanh/option_baohanh',
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
