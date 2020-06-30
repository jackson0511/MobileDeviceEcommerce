@extends('admin.layouts.index')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Thể Loại</h4>
            <ol class="breadcrumb">
                <li><a href="admin/trangchu">Trang chủ</a></li>
                <li><a href="#">Thể loại</a></li>
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

                    <form action="admin/theloai/sua/{{$theloai_edit->id}}" method="post" data-parsley-validate novalidate>
                        {{csrf_field()}}
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="userName">Tên thể loại</label>
                                <input type="text" name="ten" parsley-trigger="change" required
                                       placeholder="Nhập tên thể loại" class="form-control"
                                       value="{{$theloai_edit->Ten}}"
                                >
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Parent</label>
                                <select class="form-control" name="parent_id" id="parent_id">
                                    <option value="-1">--Chọn parent--</option>
                                    <option
                                        @if($theloai_edit->parent_id==0)
                                            {{'selected'}}
                                        @endif
                                        value="0">Root</option>
                                    @foreach($theloai as $tl)
                                        <option
                                            @if($theloai_edit->parent_id==$tl->id)
                                                {{'selected'}}
                                            @endif
                                            value="{{$tl->id}}">{{$tl->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Trạng thái</label>
                                <div class="radio radio-custom radio-inline">
                                    <input
                                        @if($theloai_edit->TrangThai==1)
                                            {{'checked'}}
                                        @endif
                                        type="radio" id="inlineRadio1" value="1" name="trangthai" checked="">
                                    <label for="inlineRadio1"> Hiện </label>
                                </div>
                                <div class="radio radio-custom radio-inline">
                                    <input
                                        @if($theloai_edit->TrangThai==0)
                                             {{'checked'}}
                                        @endif
                                        type="radio" id="inlineRadio2" value="0" name="trangthai">
                                    <label for="inlineRadio2"> Ẩn </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group ">
                                <label>Thuộc tính</label>
                                <br>
                                    @foreach($thuoctinh as $tt)
                                        <input
                                         @if(count($theloai_edit->thuoctinh)>0)
                                         @foreach($theloai_edit->thuoctinh as $tts)
                                            @if($tts->pivot->idTT==$tt->id)
                                                {{'checked'}}
                                            @endif
                                            type="checkbox" class="form-group thuoctinh " name="thuoctinh[]" value="{{$tt->id}}"
                                         @endforeach
                                         @else
                                            type="checkbox" class="form-group thuoctinh " name="thuoctinh[]" value="{{$tt->id}}"
                                         @endif
                                        >
                                        {{$tt->Ten}}
                                        <br>
                                    @endforeach
                            </div>
                        </div>

                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary waves-effect waves-light" type="submit">
                                Save
                            </button>
                            <button type="reset" class="btn btn-default waves-effect waves-light m-l-5">
                                Cancel
                            </button>
                        </div>

                    </form>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
