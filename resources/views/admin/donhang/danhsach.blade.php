@extends('admin.layouts.index')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <h4 class="page-title">Đơn hàng</h4>
            <ol class="breadcrumb">
                <li><a href="admin/trangchu">Trang chủ</a></li>
                <li><a href="admin/donhang/danhsach">Đơn hàng</a></li>
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
                <div class="col-lg-12 text-center">
                    <form class="form-inline" action="admin/donhang/danhsach" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Filter</label>
                            <select class="form-control" name="trangthai" id="trangthai">
                                <option
                                    @if($id==-1)
                                    {{'selected'}}
                                    @endif
                                    value="-1">Tất cả</option>
                                <option
                                    @if($id==0)
                                    {{'selected'}}
                                    @endif
                                    value="0">Chưa xử lý</option>
                                <option
                                @if($id==1)
                                    {{'selected'}}
                                    @endif
                                    value="1">Đã xử lý</option>
                                <option
                                    @if($id==2)
                                    {{'selected'}}
                                    @endif
                                    value="2">Đang giao</option>
                                <option
                                    @if($id==3)
                                    {{'selected'}}
                                    @endif
                                    value="3">Đã giao</option>
                                <option
                                    @if($id==4)
                                    {{'selected'}}
                                    @endif
                                    value="4">Huỷ</option>
                            </select>
                        </div>
                        <button class="btn btn-default">sort</button>
                    </form>
                </div>
                <!-- end filter-->
                <table id="datatable" class="table list-order table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tổng tiền</th>
                        <th>Tổng tiền đã giảm</th>
                        <th>Khách hàng</th>
                        <th>Mã khuyến mãi</th>
                        <th>Trạng thái</th>
                        <th>Huỷ</th>
                        <th>Thời gian</th>
                        <th>CTĐH</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($donhang as $key => $dh)
                        <tr align="center" >
                            <td>{{$key+1}}</td>
                            <td>{{number_format($dh->TongTien,0,',','.').'đ'}}</td>
                            <td>{{number_format($dh->TongTien_DaGiam,0,',','.').'đ'}}</td>
                            <td>{{$dh->khachhang->HoTen}}</td>
                            <td>
                                @if($dh->idMaKM!=0)
                                {{$dh->makhuyenmai->Code}}
                                @else
                                    {{'Không có mã khuyến mãi'}}
                                @endif
                            </td>
                            <td>
                                <a href="admin/donhang/xulydonhang/{{$dh->id}}" class="btn btn-xs
                                   @if($dh->TrangThai==0)
                                    {{'btn-danger'}}
                                    @elseif($dh->TrangThai==4)
                                    {{'btn-danger'}}
                                    @else
                                    {{'btn-default'}}
                                    @endif
                                    ">
                                    @if($dh->TrangThai==1)
                                        {{'Xử lý'}}
                                    @elseif($dh->TrangThai==2)
                                        {{'Đang giao hàng'}}
                                    @elseif($dh->TrangThai==3)
                                        {{'Đã giao hàng'}}
                                    @elseif($dh->TrangThai==4)
                                        {{'Đã huỷ'}}
                                    @else
                                        {{'Chưa xử lý'}}
                                    @endif

                                </a>
                            </td>
                            <td>
                                @if($dh->TrangThai==1||$dh->TrangThai==2)
                                    <a href="admin/donhang/xulyhuy/{{$dh->id}}" style="display: block;" class="btn btn-xs btn-danger" >
                                        Huỷ
                                    </a>
                                @else
                                    <a class="btn btn-xs btn-info" >
                                        Hoàn tất
                                    </a>
                                @endif
                            </td>
                            <td>{{$dh->created_at->format('d-m-Y')}}</td>
                            <td>
                                <a class="view" data-key={{$dh->id}} >
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

    <div class="container">
        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Chi tiết đơn hàng #<b class="idhoadon" ></b></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body ketqua">
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

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
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(".view").click(function(){
                $("#loading").show();
                var id=$(this).attr("data-key");
                setTimeout(function() {
                    $("#myModal").modal('show');
                    $(".idhoadon").text(id);
                }, 500);
                $.ajax({
                    method: "POST",
                    url: 'ajax/chitietdonhang',
                    data: {
                        id:id
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
