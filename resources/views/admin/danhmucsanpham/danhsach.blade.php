@extends('admin.layouts.index')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <h4 class="page-title">Danh mục sản phẩm</h4>
            <ol class="breadcrumb">
                <li><a href="admin/trangchu">Trang chủ</a></li>
                <li><a href="admin/danhmucsanpham/danhsach">Danh mục sản phẩm</a></li>
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
                        <th>Tên </th>
                        <th>Sửa</th>
                        <th>Xoá</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($danhmucsanpham as $dmsp)
                        <tr align="center" >
                            <td>{{$dmsp->id}}</td>
                            <td>{{$dmsp->Ten}}</td>
                            <td>
                                <i class="fa fa-pencil">
                                    <a href="admin/danhmucsanpham/sua/{{$dmsp->id}}">
                                        Sửa
                                    </a>
                                </i>
                            </td>
                            <td>
                                <i class="fa fa-trash">
                                    <a href="admin/danhmucsanpham/xoa/{{$dmsp->id}}">
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
