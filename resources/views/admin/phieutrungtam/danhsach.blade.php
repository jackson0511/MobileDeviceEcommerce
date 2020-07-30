@extends('admin.layouts.index')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <h4 class="page-title">Trung tâm</h4>
            <ol class="breadcrumb">
                <li><a href="admin/trangchu">Trang chủ</a></li>
                <li><a href="admin/phieutrungtam/danhsach">Trung tâm</a></li>
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
                        <th>Ngày tạo</th>
                        <th>Mã bảo hành</th>
                        <th>Ngày gửi</th>
                        <th>Ngày trả</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="ketqua-trungtam">
                    @foreach($phieutrungtam as $key => $ptt)
                        <tr align="center" >
                            <td class="key">{{$key+1}}</td>
                            <td>{{date('m/d/Y H:i:s',strtotime($ptt->NgayTao))}}</td>
                            <td class="view-phieubaohanh" data-key="{{$ptt->phieubaohanh->id}}"><a href="javascript:void(0)">{{$ptt->phieubaohanh->id}}</a></td>
                            <td>{{$ptt->NgayGui}}</td>
                            <td>{{$ptt->NgayTra}}</td>
                            <td>
                                <a class="btn btn-xs
                                    @if($ptt->TrangThai==0)
                                        {{'btn-info'}}
                                    @else
                                        {{'btn-default'}}
                                    @endif
                                    ">
                                    @if($ptt->TrangThai==1)
                                        {{'Đang xử lý'}}
                                    @elseif($ptt->TrangThai==2)
                                        {{'Đã xử lý'}}
                                    @elseif($ptt->TrangThai==3)
                                        {{'Hoàn thành'}}
                                    @else
                                        {{'Tiếp nhận '}}
                                    @endif

                                </a>
                            </td>
                            <td>
                                <ul class="nav navbar-nav ">
                                <li class="dropdown navbar-c-items">
                                    <a href="" class="dropdown-toggle waves-effect waves-light profile" data-toggle="dropdown" aria-expanded="true"><i class="md md-settings"></i> </a>
                                    <ul class="dropdown-menu" style="min-width: 100px; right: 0;left: unset">
                                        <li><a href="javascript:void(0)" class="view-phieubaohanh" data-key="{{$ptt->id}}"><i class="fa fa-eye m-r-10"></i>Chi tiết </a></li>
                                        @if($ptt->TrangThai==0 || $ptt->TrangThai==1 ||$ptt->TrangThai==2)
                                            <li><a href="admin/phieutrungtam/update-status/{{$ptt->id}}"><i class="md md-forward m-r-10"></i>Chuyển trạng thái</a></li>
                                        @endif
                                        @if($ptt->TrangThai==3)
                                            <li><a href="admin/phieutrungtam/tra-ve/{{$ptt->id}}"><i class="md md-forward m-r-10"></i>Trả về</a></li>
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
            $(".view-phieubaohanh").click(function () {
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
        });
    </script>
@endsection
