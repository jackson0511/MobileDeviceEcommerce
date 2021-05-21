@extends('admin.layouts.index')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <h4 class="page-title">Mã khuyến mãi</h4>
            <ol class="breadcrumb">
                <li><a href="admin/trangchu">Trang chủ</a></li>
                <li><a href="admin/makhuyenmai/danhsach">Mã khuyến mãi</a></li>
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
                        <th>Code</th>
                        <th>Ngày áp dụng</th>
                        <th>Ngày kết thúc</th>
                        <th>Giá trị</th>
                        <th>Trạng thái</th>
                        <th>Sửa</th>
                        <th>Xoá</th>
                    </tr>
                    </thead>


                    <tbody>
                    @foreach($makhuyenmai as $makm)
                        <tr align="center" >
                            <td>{{$makm->id}}</td>
                            <td>{{$makm->Ten}}</td>
                            <td>{{$makm->Code}}</td>
                            <td>{{$makm->NgayApDung}}</td>
                            <td>{{$makm->NgayKetThuc}}</td>
                            <td>{{$makm->GiaTri}}</td>
                            <td>
                                <a href="admin/makhuyenmai/xuly/{{$makm->id}}" class="btn btn-xs {{$makm->TrangThai==1?'btn-info':'btn-danger'}} ">
                                    {{$makm->TrangThai==1?'Áp dụng':'Không áp dụng'}}
                                </a>
                            </td>
                            <td>
                                <i class="fa fa-pencil">
                                    <a href="admin/makhuyenmai/sua/{{$makm->id}}">
                                        Sửa
                                    </a>
                                </i>
                            </td>
                            <td>
                                <i class="fa fa-trash">
                                    <a href="admin/makhuyenmai/xoa/{{$makm->id}}"
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
