@extends('admin.layouts.index')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Trung tâm</h4>
            <ol class="breadcrumb">
                <li><a href="admin/trangchu">Trang chủ</a></li>
                <li><a href="admin/phieutrungtam/danhsach">Trung tâm</a></li>
                <li class="active">Cập nhập trạng thái</li>
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

                    <form action="admin/phieutrungtam/update-status/{{$phieutrungtam->id}}" method="post" data-parsley-validate novalidate>
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="userName">Trạng thái</label>
                            <select name="trangthai" class="form-control">
                                @if($phieutrungtam->TrangThai==0)
                                    <option value="1">Đang xử lý</option>
                                    <option value="2">Đã xử lý</option>
                                    <option value="3">Hoàn thành</option>
                                @elseif($phieutrungtam->TrangThai==1)
                                    <option value="2">Đã xử lý</option>
                                    <option value="3">Hoàn thành</option>
                                @elseif($phieutrungtam->TrangThai==2)
                                    <option value="3">Hoàn thành</option>
                                @endif
                            </select>
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
