@extends('admin.layouts.index')
@section('content')
    <style>
        .progressbar_img{
            text-align: center!important;
            display: flex;
            flex-direction: row;
            justify-content: center;
        }
        .progressbar_img img{
            height: 25px;
            width: 25px;
        }
        ul.progressbar_img li.active_img img{
            border: 2px solid #00ff50;
        }
        ul.progressbar_img li.cancel img{
            border: 2px solid red;
        }
        ul.progressbar_img li.cancel_all img{
            border: 2px solid blue;
        }
        ul.progressbar_img li {
            width: 120px;
            float: left;
            list-style-type: none;
        }
        .progressbar:not(.hoang) {
            margin: 0;
            padding: 10px 0;
            counter-reset: step;
        }
        .progressbar_img:not(.hoang) {
            margin: 0;
            padding: 0;
            counter-reset: step;
        }
        .progressbar li span{
            font-size: 11px;
        }
        .progressbar li:not(.hoang) {
            list-style-type: none;
            width: 15%;
            /*width: 25%;*/
            float: left;
            font-size: 12px;
            position: relative;
            text-align: center;
            /*text-transform: uppercase;*/
            color: #7d7d7d;
            z-index: 0;
        }
        .progressbar li:not(.hoang):before {
            width: 10px;
            height: 10px;
            content: ' ';
            counter-increment: step;
            line-height: 51px;
            border: 5px solid #7d7d7d;
            display: block;
            text-align: center;
            margin: 0 auto 10px auto;
            border-radius: 50%;
            background-color: white;
        }
        .progressbar li:not(.hoang):after {
            width: 100%!important;
            height: 2px!important;
            content: ''!important;
            position: absolute!important;
            background-color: #7d7d7d!important;
            top: 4px!important;
            left: -50%!important;
            z-index: -1!important;
        }
        .progressbar li:first-child:after {
            content: none;
            display: none;
        }
        .progressbar li.active_ch:before {
            border-color: red;
        }
        .progressbar li.active:not(.hoang) {
            color: green;
        }
        .progressbar li.active:not(.hoang):before {
            border-color: #55b776;
        }
        .progressbar li.cancel:before {
            border-color: red;
        }
        .progressbar li.active + li:after {
            background-color: #55b776!important;
        }
    </style>
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

                <table id="datatable" class="table table-striped table-bordered table-hover">
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
                                <a href="admin/khuyenmai/update/{{$km->id}}" class="btn btn-xs {{$km->TrangThai==1?'btn-info':'btn-danger'}}">
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" style="font-weight: bold; text-transform: uppercase">Chi tiết khuyến mãi #<b class="idkhuyenmai" ></b></h4>
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
    <div id="loading" style="display: none">
        <img src="images/loading.gif"  alt="">
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
                $("#loading").show();
                var id=$(this).attr("data-key");
                setTimeout(function() {
                    $("#myModal").modal('show');
                    $(".idkhuyenmai").text(id);
                }, 500);

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
                        setTimeout(function() {
                            $("#loading").hide();
                        }, 500);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection

