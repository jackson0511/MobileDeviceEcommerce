@extends('admin.layouts.index')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <h4 class="page-title">Sản phẩm</h4>
            <ol class="breadcrumb">
                <li><a href="admin/trangchu">Trang chủ</a></li>
                <li><a href="admin/sanpham/danhsach">Sản phẩm</a></li>
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
                        <th >Nội Dung</th>
                        <th width="290px">Tóm Tắt</th>
                        <th>Trạng thái</th>
                        <th>Thể Loại</th>
                        <th>Sửa</th>
                        <th>Xoá</th>
                    </tr>
                    </thead>


                    <tbody>
                    @foreach($sanpham as $sp)
                        <tr align="center" >
                            <td>{{$sp->id}}</td>
                            <td>
                                <p>Tên: {{$sp->Ten}} </p>
                                <img width="150px" src="upload/sanpham/{{$sp->Hinh}}" alt="">
                                <p>Giá :{{$sp->Gia}}</p>
                                <p>Số Lượng :{{$sp->SoLuong}}</p>
                                <p>Tình trạng :
                                    @if($sp->TinhTrang==1)
                                        {{'Hàng mới'}}
                                    @elseif($sp->TinhTrang==2)
                                        {{'Hàng like new'}}
                                    @else
                                        {{'Hàng trưng bày'}}
                                    @endif
                                </p>
                            </td>
                            <td>{{$sp->TomTat}}</td>
                            <td>
                                <a class="btn btn-xs {{$sp->TrangThai==1?'btn-info':'btn-danger'}} ">
                                    {{$sp->TrangThai==1?'Hiển thị':'Ẩn'}}
                                </a>
                            </td>
                            <td>{{$sp->theloai->Ten}}</td>
                            <td>
                                <i class="fa fa-pencil">
                                    <a href="admin/sanpham/sua/{{$sp->id}}">
                                        Sửa
                                    </a>
                                </i>
                            </td>
                            <td>
                                <i class="fa fa-trash">
                                    <a href="admin/sanpham/xoa/{{$sp->id}}"
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
