@extends('admin.layouts.index')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <h4 class="page-title">Tin tức</h4>
            <ol class="breadcrumb">
                <li><a href="admin/trangchu">Trang chủ</a></li>
                <li><a href="admin/tintuc/danhsach">Tin tức</a></li>
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
                        <th width="300px">Tên</th>
                        <th>Hình</th>
                        <th>Sản phẩm</th>
                        <th>Quản trị</th>
                        <th>Sửa</th>
                        <th>Xoá</th>
                    </tr>
                    </thead>


                    <tbody>
                    @foreach($tintuc as $tt)
                        <tr align="center" >
                            <td>{{$tt->id}}</td>
                            <td>{{$tt->TieuDe}}</td>
                            <td>
                                <img width="150px" src="upload/tintuc/{{$tt->Hinh}}" alt="{{$tt->Hinh}}">
                            </td>
                            <td>{{$tt->sanpham->Ten}}</td>
                            <td>{{$tt->quantri->HoTen}}</td>
                            <td>
                                <i class="fa fa-pencil">
                                    <a href="admin/tintuc/sua/{{$tt->id}}">
                                        Sửa
                                    </a>
                                </i>
                            </td>
                            <td>
                                <i class="fa fa-trash">
                                    <a href="admin/tintuc/xoa/{{$tt->id}}"
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
