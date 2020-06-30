@extends('admin.layouts.index')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <h4 class="page-title">Bình luận</h4>
            <ol class="breadcrumb">
                <li><a href="admin/trangchu">Trang chủ</a></li>
                <li><a href="admin/binhluan/danhsach">Bình luận</a></li>
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
                        <th width="400px">Nội dung</th>
                        <th>Trạng thái</th>
                        <th>Khách hàng</th>
                        <th>Trả lời</th>
                    </tr>
                    </thead>


                    <tbody>
                    @foreach($binhluan as $bl)
                        @if($bl->parent_id==0)
                            <tr>
                                <td>{{$bl->id}}</td>
                                <td>
                                    {{$bl->NoiDung}}
                                    @if(count($bl->children)>0)
                                        <table  style="margin-left:50px" >
                                        @foreach($bl->children as $child)
                                            <tr>
                                                <td width="200px" height="30px" >{{"- ".$child->NoiDung}}</td>
                                                <td>
                                                    <a class="btn btn-xs {{$child->TrangThai_Admin==1?'btn-info':'btn-danger'}} ">
                                                        {{$child->TrangThai_Admin==1?'Admin':'Khách hàng'}}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </table>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-xs {{$bl->TrangThai==1?'btn-info':'btn-danger'}} ">
                                        {{$bl->TrangThai==1?'Đã trả lời':'Chưa trả lời'}}
                                    </a>
                                </td>
                                <td>{{$bl->khachhang->HoTen}}</td>
                                <td>
                                    <a href="admin/binhluan/traloi/{{$bl->id}}" >
                                        trả lời
                                    </a>
                                </td>
                            </tr>

                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
