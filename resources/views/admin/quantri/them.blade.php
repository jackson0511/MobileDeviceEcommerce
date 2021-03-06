@extends('admin.layouts.index')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Nhân Viên</h4>
            <ol class="breadcrumb">
                <li><a href="admin/trangchu">Trang chủ</a></li>
                <li><a href="admin/quantri/danhsach">Nhân Viên</a></li>
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

                <form action="admin/quantri/them" method="post" data-parsley-validate novalidate>
                    {{csrf_field()}}
                        <div class="form-group">
                            <label for="userName">Email</label>
                            <input type="email" name="email" parsley-trigger="change" required  placeholder="Nhập email" value="{{old('email')}}" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="userName">Mật khẩu</label>
                            <input type="password" name="password" parsley-trigger="change" required  placeholder="Nhập password"  class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="userName">Nhập lại mật khẩu</label>
                            <input type="password" name="passwordagain" parsley-trigger="change" required  placeholder="Nhập lại password"  class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="userName">Họ và tên</label>
                            <input type="text" name="ten" parsley-trigger="change" required  placeholder="Nhập họ tên" value="{{old('ten')}}"  class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="userName">Số điện thoại</label>
                            <input type="text" name="sdt" parsley-trigger="change" required  placeholder="Nhập số điện thoại"  value="{{old('sdt')}}" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Quyền</label>
                            <select multiple class="form-control" name="quyen[]" >
                                @foreach($quyen as $q)
                                    <option value="{{$q->id}}">{{$q->Ten}}</option>
                                @endforeach
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

