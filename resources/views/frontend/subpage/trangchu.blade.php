@extends("frontend.index")
@section('content')
    @include('frontend.subpage.content')
    <div style="top: 30%" class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Nhập email để nhận mã khuyến mãi</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body ">
                    <h4 style="font-size: 25px" class="text-center mb-5">{{$theloaikm->Ten}}</h4>
                    <form action="share-coupon" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <input type="email" name="email" parsley-trigger="change" required   placeholder="Nhập email để nhận mã khuyến mãi" class="form-control" >
                        </div>
                        <div class="form-group text-right">
                            <button class="btn btn-danger">Submit</button>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            let data="{{$data_km}}";
            var data_km=JSON.parse(data.replace(/&quot;/g,'"'));
            if(data_km['ngay']>=data_km['ngayapdung'] && data_km['ngay']<=data_km['ngayketthuc']){
                $(".show-coupon-index").addClass('show');
                $(".show-coupon-index").addClass('coupon-show');
            }else{
                $(".show-coupon-index").removeClass('show');
                $(".show-coupon-index").removeClass('coupon-show');
            }
            $(".coupon-show").click(function () {
                $("#myModal").modal('show');
            });
        });
    </script>
@endsection

