@extends('admin.layouts.index')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <h4 class="page-title">Thể Loại</h4>
            <ol class="breadcrumb">
                <li><a href="admin/trangchu">Trang chủ</a></li>
                <li><a href="admin/theloai/danhsach">Thể loại</a></li>
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
                        <th>Tên</th>
                        <th>Parent</th>
                        <th>Trạng thái</th>
                        <th>Sửa</th>
                        <th>Xoá</th>
                    </tr>
                    </thead>


                    <tbody>
                    @foreach($theloai as $tl)
                        <tr align="center" >
                            <td>{{$tl->id}}</td>
                            <td>{{$tl->Ten}}</td>
                            @if($tl->parent!=null)
                                <td>{{$tl->parent->Ten}}</td>
                            @else
                                <td>{{'Root'}}</td>
                            @endif
                            <td>
                                <a class="btn btn-xs {{$tl->TrangThai==1?'btn-info':'btn-danger'}} " href="admin/theloai/xuly/{{$tl->id}}">
                                    {{$tl->TrangThai==1?'Hiện':'Ẩn'}}
                                </a>
                            </td>
                            <td>
                                <i class="fa fa-pencil">
                                    <a href="admin/theloai/sua/{{$tl->id}}">
                                        Sửa
                                    </a>
                                </i>
                            </td>
                            <td>
                                <i class="fa fa-trash">
                                    <a href="admin/theloai/xoa/{{$tl->id}}"
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
