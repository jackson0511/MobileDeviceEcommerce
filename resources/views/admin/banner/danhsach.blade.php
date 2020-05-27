@extends('admin.layouts.index')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <h4 class="page-title">Banner</h4>
            <ol class="breadcrumb">
                <li><a href="admin/trangchu">Trang chủ</a></li>
                <li><a href="admin/banner/danhsach">Banner</a></li>
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
                        <th width="190px">Tên</th>
                        <th>Hình</th>
                        <th>Sản phẩm</th>
                        <th>Quản trị</th>
                        <th>Trạng thái</th>
                        <th>Sửa</th>
                        <th>Xoá</th>
                    </tr>
                    </thead>


                    <tbody>
                    @foreach($banner as $bner)
                        <tr align="center" >
                            <td>{{$bner->id}}</td>
                            <td>{{$bner->Ten}}</td>
                            <td>
                                <img width="150px" src="upload/banner/{{$bner->Hinh}}" alt="{{$bner->Hinh}}">
                            </td>
                            <td>{{$bner->sanpham->Ten}}</td>
                            <td>{{$bner->quantri->HoTen}}</td>
                            <td>
                                <a class="btn btn-xs {{$bner->TrangThai==1?'btn-info':'btn-danger'}} ">
                                    {{$bner->TrangThai==1?'Hiện':'Ẩn'}}
                                </a>
                            </td>
                            <td>
                                <i class="fa fa-pencil">
                                    <a href="admin/banner/sua/{{$bner->id}}">
                                        Sửa
                                    </a>
                                </i>
                            </td>
                            <td>
                                <i class="fa fa-trash">
                                    <a href="admin/banner/xoa/{{$bner->id}}"
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
