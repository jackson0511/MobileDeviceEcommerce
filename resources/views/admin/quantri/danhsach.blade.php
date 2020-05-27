@extends('admin.layouts.index')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <h4 class="page-title">Nhân viên</h4>
            <ol class="breadcrumb">
                <li><a href="admin/trangchu">Trang chủ</a></li>
                <li><a href="admin/quantri/danhsach">Nhân viên</a></li>
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
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Họ Tên</th>
                        <th>Quyền</th>
                        <th>Sửa</th>
                        <th>Xoá</th>
                    </tr>
                    </thead>


                    <tbody>
                    @foreach($quantri as $qt)
                        <tr align="center" >
                            <td>{{$qt->id}}</td>
                            <td>{{$qt->Email}}</td>
                            <td>{{$qt->SoDienThoai}}</td>
                            <td>{{$qt->HoTen}}</td>
                            <td>
                                <a class="btn btn-xs btn-info">
                                    @if(count($qt->quyen)>1)
                                        @foreach($qt->quyen as $q)
                                            {{$q->Ten.','}}
                                        @endforeach
                                    @else
                                        {{$qt->quyen[0]->Ten}}
                                    @endif
                                </a>
                            </td>
                            <td>
                                <i class="fa fa-pencil">
                                    <a href="admin/quantri/sua/{{$qt->id}}">
                                        Sửa
                                    </a>
                                </i>
                            </td>
                            <td>
                                <i class="fa fa-trash">
                                    <a href="admin/quantri/xoa/{{$qt->id}}"
                                       onclick="return confirm('Bạn có chắc muốn xoá không?');"
                                    >
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
