@extends('admin.layouts.index')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <h4 class="page-title">Ảnh slide sản phẩm</h4>
            <ol class="breadcrumb">
                <li><a href="admin/trangchu">Trang chủ</a></li>
                <li><a href="#">Ảnh slide sản phẩm</a></li>
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
                        <th>Ảnh trên</th>
                        <th>Ảnh dưới</th>
                        <th>Sản phẩm </th>
                        <th>Sửa</th>
                        <th>Xoá</th>
                    </tr>
                    </thead>


                    <tbody>
                    @foreach($anhslidesp as $anhslsp)
                        <tr align="center" >
                            <td>{{$anhslsp->id}}</td>
                            <td>
                                <img style="width: 100px" src="upload/anhslidesp/{{$anhslsp->AnhTren}}" alt="">
                            </td>
                            <td>
                                <img style="width: 100px" src="upload/anhslidesp/{{$anhslsp->AnhDuoi}}" alt="">
                            </td>
                            <td>{{$anhslsp->sanpham->Ten}}</td>
                            <td>
                                <i class="fa fa-pencil">
                                    <a href="admin/anhslidesanpham/sua/{{$anhslsp->id}}">
                                        Sửa
                                    </a>
                                </i>
                            </td>
                            <td>
                                <i class="fa fa-trash">
                                    <a href="admin/anhslidesanpham/xoa/{{$anhslsp->id}}"
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
