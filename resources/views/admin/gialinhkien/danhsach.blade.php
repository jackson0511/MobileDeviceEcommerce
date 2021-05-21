@extends('admin.layouts.index')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <h4 class="page-title">Giá linh kiện</h4>
            <ol class="breadcrumb">
                <li><a href="admin/trangchu">Trang chủ</a></li>
                <li><a href="admin/gialinhkien/danhsach">Giá linh kiện</a></li>
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
                <!-- filter -->
                <div class="row">
                    <div class="col-md-12 p-0  text-center">
                        <form class="form-inline" action="admin/thongtinbaohanh/danhsach" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Tìm kiếm</label>
                                <input type="text" class="form-control" name="keyword" placeholder="nhập imei để tìm">
                            </div>
                            <button class="btn btn-default">Tìm</button>
                        </form>
                    </div>
                </div>
                <!-- end filtet-->
                <table id="datatable" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên linh kiện</th>
                        <th>Giá sửa</th>
                        <th>Số lượng </th>
                        <th>Trạng thái</th>
                        <th>Sản phẩm</th>
                        <th>Sửa</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($gialinhkien as $value)
                        <tr align="center" >
                            <td>{{$value->id}}</td>
                            <td>{{$value->Ten_LinhKien}}</td>
                            <td>{{number_format($value->Gia_Sua,0,',','.').'đ'}}</td>
                            <td>{{$value->SoLuong}}</td>
                            <td>
                                <a class="btn btn-xs {{$value->TrangThai==0?'btn-danger':'btn-info'}} ">
                                    {{$value->TrangThai==0?'hết hàng':'còn hàng'}}
                                </a>
                            </td>
                            <td>{{$value->danhmucsanpham->Ten}}</td>
                            <td>
                                <i class="fa fa-pencil">
                                    <a href="admin/gialinhkien/sua/{{$value->id}}">
                                        Sửa
                                    </a>
                                </i>
                            </td>
{{--                            <td>--}}
{{--                                <a class="view" data-key="{{$ttbh->id}}">--}}
{{--                                    <i class="fa fa-eye"></i>--}}
{{--                                </a>--}}
{{--                            </td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
{{--                <div class="row">--}}
{{--                    <div class="col-lg-6">--}}
{{--                        <form  action="admin/gialinhkien/import-csv">--}}
{{--                            <div class="form-group">--}}
{{--                                <span>Import data from excel</span>--}}
{{--                                <input type="file" name="file" class="filestyle" data-buttonbefore="true">--}}
{{--                            </div>--}}
{{--                            <button class="btn btn-default">import</button>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
