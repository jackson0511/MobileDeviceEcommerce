@extends('admin.layouts.index')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <h4 class="page-title">Đơn hàng</h4>
            <ol class="breadcrumb">
                <li><a href="admin/trangchu">Trang chủ</a></li>
                <li><a href="admin/donhang/danhsach" >Đơn hàng</a></li>
                <li class="active">Xử lý đơn hàng</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10">
            <div class="card-box">

                <p class="text-muted font-13 m-b-30">
                @if(count($errors)>0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                            {{$err}}
                            <br>
                        @endforeach
                    </div>
                    @endif
                    </p>

                    <form action="admin/donhang/xulydonhang/{{$donhang->id}}" method="post" data-parsley-validate novalidate >
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="userName">Tổng tiền</label>
                            <input type="text" name="tongtien" parsley-trigger="change" readonly  value="{{ $donhang->TongTien }}" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="userName">Tổng tiền đã giảm</label>
                            <input type="text" name="tongtiendagiam" parsley-trigger="change" readonly  value="{{ $donhang->TongTien_DaGiam }}" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="userName">Ghi chú</label>
                            <textarea name="ghichu" class="form-control" disabled="true" id="" cols="30" rows="10">{{$donhang->GhiChu}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select class="form-control" name="trangthai" id="trangthai">
                                {{-- don hang bang 0 --}}
                                @if($donhang->TrangThai==0)
                                    {{--kt don hang bang 0 --}}
                                    <option
                                        @if($donhang->TrangThai==0)
                                        {{'selected'}}
                                        @endif
                                        value="0">Chưa xử lý</option>
                                    <option
                                        @if($donhang->TrangThai==1)
                                        {{'selected'}}
                                        @endif
                                        value="1">Đã xử lý</option>
                                    <option
                                        @if($donhang->TrangThai==2)
                                        {{'selected'}}
                                        @endif
                                        value="2">Đang giao hàng</option>
                                    <option
                                        @if($donhang->TrangThai==3)
                                        {{'selected'}}
                                        @endif
                                        value="3">Đã giao hàng</option>
                                    <option
                                        @if($donhang->TrangThai==4)
                                        {{'selected'}}
                                        @endif
                                        value="4">Huỷ</option>
                                    {{-- don hang bang 1 --}}
                                @elseif($donhang->TrangThai==1)
                                    {{-- kt don hang bang 1 --}}
                                    <option
                                        @if($donhang->TrangThai==1)
                                        {{'selected'}}
                                        @endif
                                        value="1">Đã xử lý</option>
                                    <option
                                        @if($donhang->TrangThai==2)
                                        {{'selected'}}
                                        @endif
                                        value="2">Đang giao hàng</option>
                                    <option
                                        @if($donhang->TrangThai==3)
                                        {{'selected'}}
                                        @endif
                                        value="3">Đã giao hàng</option>
                                    {{-- don hang bang 2 --}}
                                @elseif($donhang->TrangThai==2)
                                    {{-- kt don hang bang 2 --}}
                                    <option
                                        @if($donhang->TrangThai==2)
                                        {{'selected'}}
                                        @endif
                                        value="2">Đang giao hàng</option>
                                    <option
                                        @if($donhang->TrangThai==3)
                                        {{'selected'}}
                                        @endif
                                        value="3">Đã giao hàng</option>
                                    {{-- don hang bang 3 --}}
                                @elseif($donhang->TrangThai==3)
                                    {{-- kt don hang bang 3 --}}
                                    <option
                                        @if($donhang->TrangThai==3)
                                        {{'selected'}}
                                        @endif
                                        value="3">Đã giao hàng</option>

                                    {{-- don hang bang 4 --}}
                                @elseif($donhang->TrangThai==4)
                                    {{-- kt don hang bang 4 --}}
                                    <option
                                        @if($donhang->TrangThai==4)
                                        {{'selected'}}
                                        @endif
                                        value="4">Huỷ</option>

                                @endif
                            </select>
                        </div>

                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary waves-effect waves-light" type="submit">
                                Save
                            </button>
                            <button type="reset" class="btn btn-default waves-effect waves-light m-l-5 button">
                                <a href="admin/donhang/danhsach">Cancel</a>
                            </button>
                        </div>

                    </form>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
