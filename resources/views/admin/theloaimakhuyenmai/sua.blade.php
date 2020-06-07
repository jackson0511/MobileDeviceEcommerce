@extends('admin.layouts.index')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Thể Loại Mã khuyến mãi</h4>
            <ol class="breadcrumb">
                <li><a href="admin/trangchu">Trang chủ</a></li>
                <li><a href="admin/theloaimakhuyenmai/danhsach">Thể Loại Mã khuyến mãi</a></li>
                <li class="active">Sửa</li>
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

                    <form action="admin/theloaimakhuyenmai/sua/{{$theloaimakhuyenmai->id}}" method="post" data-parsley-validate novalidate >
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="userName">Tên</label>
                            <input type="text" name="ten" parsley-trigger="change"   placeholder="Nhập tên mã khuyến mãi" value="{{ $theloaimakhuyenmai->Ten }}" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="userName">Code</label>
                            <input type="text" readonly name="code" parsley-trigger="change"   placeholder="Nhập mã khuyến mãi" value="{{ $theloaimakhuyenmai->Code }}" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label>Ngày Áp Dụng</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="ngayapdung" value="{{ date('m/d/Y',strtotime($theloaimakhuyenmai->NgayApDung))}}" placeholder="mm/dd/yyyy" id="datepicker">
                                <span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Ngày Kết Thúc</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="ngayketthuc" value="{{ date('m/d/Y',strtotime($theloaimakhuyenmai->NgayKetThuc))}}" placeholder="mm/dd/yyyy" id="datepicker-autoclose">
                                <span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="userName">Giá Trị</label>
                            <input type="text" name="giatri" parsley-trigger="change"   placeholder="Nhập giá trị" value="{{ $theloaimakhuyenmai->GiaTri }}" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="userName">Số Lượng</label>
                            <input type="text" readonly name="soluong" parsley-trigger="change"   placeholder="Nhập số lượng" value="{{ $theloaimakhuyenmai->SoLuong }}" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <div class="radio radio-custom radio-inline">
                                <input
                                    @if($theloaimakhuyenmai->TrangThai==1)
                                    {{'checked'}}
                                    @endif
                                    type="radio" id="inlineRadio1" value="1" name="trangthai" checked="">
                                <label for="inlineRadio1"> Hiện </label>
                            </div>
                            <div class="radio radio-custom radio-inline">
                                <input
                                    @if($theloaimakhuyenmai->TrangThai==0)
                                    {{'checked'}}
                                    @endif
                                    type="radio" id="inlineRadio2" value="0" name="trangthai">
                                <label for="inlineRadio2"> Ẩn </label>
                            </div>
                        </div>

                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary waves-effect waves-light" type="submit">
                                Save
                            </button>
                            <button type="reset" class="btn btn-default waves-effect waves-light m-l-5 button">
                                <a href="admin/theloaimakhuyenmai/danhsach">Cancel</a>
                            </button>
                        </div>

                    </form>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
