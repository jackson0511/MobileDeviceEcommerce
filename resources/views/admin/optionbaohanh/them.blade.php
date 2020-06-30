@extends('admin.layouts.index')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Option Bảo hành</h4>
            <ol class="breadcrumb">
                <li><a href="admin/trangchu">Trang chủ</a></li>
                <li><a href="admin/baohanh/danhsach">Option Bảo hành</a></li>
                <li class="active">Thêm</li>
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

                <form action="admin/optionbaohanh/them" method="post" data-parsley-validate novalidate>
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="userName">Tên</label>
                        <input type="text" name="ten" parsley-trigger="change"   placeholder="Nhập tên option bảo hành" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="userName">Mô tả</label>
                        <textarea name="mota" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary waves-effect waves-light" type="submit">
                            Save
                        </button>
                        <button type="reset" class="btn btn-default waves-effect waves-light m-l-5 button">
                            <a href="admin/optionbaohanh/danhsach">Cancel</a>
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
