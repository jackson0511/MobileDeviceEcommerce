<div class="modal" id="modal_profile">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Thông tin tài khoản</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body ">
                <form action="admin/quantri/sua/{{$quantri->id}}" method="post" id="form-profile" data-parsley-validate novalidate>
                    <input type="hidden" value="{{$quantri->id}}" name="id">
                    <div class="form-group">
                        <label for="userName">Email</label>
                        <input type="email" name="email" parsley-trigger="change" required  placeholder="Nhập email" disabled value="{{$quantri->Email}}" class="form-control" >
                    </div>
                    <div class="row">
                        <div class="col-lg-7 " style="color: red">click vào đây để có nhu cầu đổi password</div>
                        <div class="col-lg-2">
                            <input  type="checkbox" class="form-control-sm" id="changepass"  name="checkpassword">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="userName">Mật khẩu cũ</label>
                        <input type="password" name="passwordold" disabled="true" parsley-trigger="change"   placeholder="Nhập password"  class="form-control password passwordold" >
                    </div>
                    <div class="form-group">
                        <label for="userName">Mật khẩu</label>
                        <input type="password" name="password" disabled="true" parsley-trigger="change"   placeholder="Nhập password"  class="form-control password" >
                    </div>
                    <div class="form-group">
                        <label for="userName">Nhập lại mật khẩu</label>
                        <input type="password" name="passwordagain" disabled="true" parsley-trigger="change"   placeholder="Nhập lại password"  class="form-control password" >
                    </div>
                    <div class="form-group">
                        <label for="userName">Họ và tên</label>
                        <input type="text" name="ten" parsley-trigger="change"  required  placeholder="Nhập họ tên" value="{{$quantri->HoTen}}"  class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="userName">Số điện thoại</label>
                        <input type="text" name="sdt" parsley-trigger="change" required  placeholder="Nhập số điện thoại"  value="{{$quantri->SoDienThoai}}" class="form-control" >
                    </div>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button class="btn btn-primary waves-effect waves-light save-profile" type="submit">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
