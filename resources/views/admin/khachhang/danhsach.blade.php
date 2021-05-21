@extends('admin.layouts.index')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <h4 class="page-title">Khách hàng</h4>
            <ol class="breadcrumb">
                <li><a href="admin/trangchu">Trang chủ</a></li>
                <li><a href="admin/khachhang/danhsach">Khách hàng</a></li>
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
                        <th>Email</th>
                        <th>Số điện thoai</th>
                        <th>Họ tên</th>
                        <th>Địa chỉ</th>
                        <th>Active</th>
                    </tr>
                    </thead>


                    <tbody>
                    @foreach($khachhang as $kh)
                        <tr align="center" >
                            <td>{{$kh->id}}</td>
                            <td>{{$kh->Email}}</td>
                            <td>{{$kh->SoDienThoai}}</td>
                            <td>{{$kh->HoTen}}</td>
                            <td>{{$kh->DiaChi}}</td>
                            <td>
                                <a class="btn btn-xs {{$kh->active==1?'btn-info':'btn-danger'}}" href="admin/khachhang/xuly/{{$kh->id}}"
                                   onclick="return confirm('Bạn có chắc muốn khoá không?');"
                                >
                                    {{$kh->active==1?'Hoạt động':'Khoá'}}
                                </a>
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
