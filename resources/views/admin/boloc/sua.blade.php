@extends('admin.layouts.index')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Bộ lọc</h4>
            <ol class="breadcrumb">
                <li><a href="admin/trangchu">Trang chủ</a></li>
                <li><a href="admin/boloc/danhsach">Bộ lọc</a></li>
                <li class="active">Sửa</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
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

                    <form action="admin/boloc/sua/{{$boloc_edit->id}}" method="post" data-parsley-validate novalidate>
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="userName">Tên</label>
                            <input type="text" name="ten" parsley-trigger="change"  value="{{$boloc_edit->Ten}}"  placeholder="Nhập tên bộ lọc" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Parent </label>
                            <select class="form-control" name="parent_id" id="parent_id">
                                <option value="-1">--Chọn parent--</option>
                                <option
                                    @if($boloc_edit->parent_id==0)
                                    {{'selected'}}
                                    @endif
                                    value="0">Root</option>
                                @foreach($boloc as $bl)
                                    <option
                                        @if($boloc_edit->parent_id==$bl->id)
                                            {{'selected'}}
                                         @endif
                                        value="{{$bl->id}}">{{$bl->Ten}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <div class="radio radio-custom radio-inline">
                                <input
                                    @if($boloc_edit->TrangThai==1)
                                    {{'checked'}}
                                    @endif
                                    type="radio" id="inlineRadio1" value="1" name="trangthai" checked="">
                                <label for="inlineRadio1"> Hiện </label>
                            </div>
                            <div class="radio radio-custom radio-inline">
                                <input
                                    @if($boloc_edit->TrangThai==0)
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
                                <a href="admin/boloc/danhsach">Cancel</a>
                            </button>
                        </div>

                    </form>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
@section('script')
    <script>
        $("#parent_id").select2({
            placeholder: "Select a category",
            allowClear: true
        });
    </script>
@endsection
