@extends('admin.layouts.index')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <h4 class="page-title">Bình luận</h4>
            <ol class="breadcrumb">
                <li><a href="admin/trangchu">Trang chủ</a></li>
                <li><a href="admin/binhluan/danhsach">Bình luận</a></li>
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
                        <th width="400px">Nội dung</th>
                        <th>Trạng thái</th>
                        <th>Khách hàng</th>
                        <th>Sửa</th>
                        <th>Xoá</th>
                    </tr>
                    </thead>


                    <tbody>
                    @foreach($binhluan as $bl)
                        <tr align="center" >
                            <td>{{$bl->id}}</td>
                            <td>{{$bl->NoiDung}}</td>
                            <td>
                                <a class="btn btn-xs {{$bl->TrangThai==1?'btn-info':'btn-danger'}} " href="admin/binhluan/xuly/{{$bl->id}}">
                                    {{$bl->TrangThai==1?'Đã trả lời':'Chưa trả lời'}}
                                </a>
                            </td>
                            <td>{{$bl->khachhang->HoTen}}</td>
                            <td>
                                <i class="fa fa-pencil">
                                    <a>
                                        Sửa
                                    </a>
                                </i>
                            </td>
                            <td>
                                <i class="fa fa-trash">
                                    <a>
                                        Xoá
                                    </a>
                                </i>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
