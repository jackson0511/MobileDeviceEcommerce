@extends("frontend.index")
@section('content')
<!-- Page title -->
<div class="page-title parallax parallax1">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="page-title-heading">
          <h1 class="title">Đơn Hàng Của Bạn</h1>
        </div><!-- /.page-title-heading -->
        <div class="breadcrumbs">
          <ul>
            <li><a href="/">TRANG CHỦ</a></li>
          </ul>
        </div><!-- /.breadcrumbs -->
      </div><!-- /.col-md-12 -->
    </div><!-- /.row -->
  </div><!-- /.container -->
</div><!-- /.page-title -->
<section class="flat-row main-shop shop-4col">
  <div class="container">
    <div class="row">
     <div class="col-md-12">
     @if(session('ThongBao'))
     <div class="alert alert-success">
      {{session('ThongBao')}}
    </div>
    @endif

    <div class="product-content product-fourcolumn clearfix">

      <div class="table-responsive text-center">
        <table id="datatable" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th scope="col">STT</th>
              <th scope="col">Tổng tiền</th>
              <th scope="col">Tổng tiền đã giảm</th>
              <th scope="col">Ghi Chú</th>
              <th scope="col">Trạng thái</th>
              <th scope="col">Xử lý</th>
              <th scope="col">CTĐH</th>
            </tr>
          </thead>
          <tbody>
            @foreach($donhang as $key =>  $dh)

            <tr>
              <td>{{$key+1}}</td>
              <td>{{number_format($dh->TongTien,0,',','.').'đ'}}</td>
              <td>{{number_format($dh->TongTien_DaGiam,0,',','.').'đ'}}</td>
              <td>{{$dh->GhiChu}}</td>
              <td class="alert
                  @if($dh->TrangThai==0)
                  {{'alert-danger'}}
                  @elseif($dh->TrangThai==4)
                  {{'alert-danger'}}
                  @else
                  {{'alert-info'}}
                  @endif
              ">
                    @if($dh->TrangThai==1)
                    {{'Xử lý'}}
                    @elseif($dh->TrangThai==2)
                    {{'Đang giao hàng'}}
                    @elseif($dh->TrangThai==3)
                    {{'Đã giao hàng'}}
                    @elseif($dh->TrangThai==4)
                    {{'Đã huỷ'}}
                    @else
                    {{'Chưa xử lý'}}
                    @endif
                </td>
                <td >
                    @if($dh->TrangThai==0)
                        <a href="huydonhang/{{$dh->id}}">Huỷ</a>
                    @else
                        <a>Không thể huỷ</a>
                    @endif
                </td>
                <td>
                    <a class="view" data-key={{$dh->id}} >
                        <i class="fa fa-eye"></i>
                    </a>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>
    </div><!-- /.product-content -->
    <div class="modal" id="myModal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Chi tiết đơn hàng #<b class="idhoadon" ></b></h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body ">
            <table class="table  table-bordered table-hover ketqua" id="dataTables-example">

            </table>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>
  </div><!-- /.col-md-12 -->
</div><!-- /.row -->
</div><!-- /.container -->
</section><!-- /.flat-row -->
<style>
  .modal{
    z-index: 100000;
  }
</style>
@endsection
@section('script')
<script>
  $(document).ready(function(){
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
    $(".view").click(function(){
      var iddh=$(this).attr('data-key');
      $("#myModal").modal('show');
      $(".idhoadon").text(iddh);
        $.ajax({
            method: "POST",
            url: 'chitietdonhang',
            data: {
                id:iddh,
            },
            success: function (data) {
                if(data!=null) {
                    $(".ketqua").html(data);
                }
            }
        });
    });
  });
</script>
@endsection
