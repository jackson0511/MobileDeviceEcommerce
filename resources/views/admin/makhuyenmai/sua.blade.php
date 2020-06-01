@extends('admin.layouts.index')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Mã khuyến mãi</h4>
            <ol class="breadcrumb">
                <li><a href="admin/trangchu">Trang chủ</a></li>
                <li><a href="admin/makhuyenmai/danhsach">Mã khuyến mãi</a></li>
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

                    <form action="admin/makhuyenmai/sua/{{$makhuyenmai->id}}" method="post" data-parsley-validate novalidate >
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="userName">Tên</label>
                            <input type="text" name="ten" parsley-trigger="change"   placeholder="Nhập tên mã khuyến mãi" value="{{ $makhuyenmai->Ten }}" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="userName">Code</label>
                            <input type="text" readonly name="code" parsley-trigger="change"   placeholder="Nhập mã khuyến mãi" value="{{ $makhuyenmai->Code }}" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label>Ngày Áp Dụng</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="ngayapdung" value="{{ date('m/d/Y',strtotime($makhuyenmai->NgayApDung))}}" placeholder="mm/dd/yyyy" id="datepicker">
                                <span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Ngày Kết Thúc</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="ngayketthuc" value="{{ date('m/d/Y',strtotime($makhuyenmai->NgayKetThuc))}}" placeholder="mm/dd/yyyy" id="datepicker-autoclose">
                                <span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="userName">Giá Trị</label>
                            <input type="text" name="giatri" parsley-trigger="change"   placeholder="Nhập giá trị" value="{{ $makhuyenmai->GiaTri }}" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <div class="radio radio-custom radio-inline">
                                <input
                                    @if($makhuyenmai->TrangThai==1)
                                    {{'checked'}}
                                    @endif
                                    type="radio" id="inlineRadio1" value="1" name="trangthai" checked="">
                                <label for="inlineRadio1"> Hiện </label>
                            </div>
                            <div class="radio radio-custom radio-inline">
                                <input
                                    @if($makhuyenmai->TrangThai==0)
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
                                <a href="admin/makhuyenmai/danhsach">Cancel</a>
                            </button>
                        </div>

                    </form>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
