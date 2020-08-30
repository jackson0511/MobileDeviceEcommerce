<!doctype html>
<html lang="vi33">
<head>
    <title></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body{
            font-family: "DejaVu Sans";
        }
        .table tr th{
            font-size: 12px;
        }
    </style>
</head>
<body>
<div class="container-fluid" style="border:2px solid rgb(74, 204, 243);padding: 5px" >
    <div class="row mt-5">
        <div class="col-md-4" style="width: 200px">
            <div>
                <img src="images/logo2.png" width="200px">
            </div>
        </div>
        <div class="col-md-8" style="width: 350px; float: right">
            <div>
                <h2 style="font-weight: bold; font-size: 15px; color: red;">CÔNG TY THHH HỆ THỐNG APPLE</h2>
                <div style="font-size: 12px">Địa chỉ: 270 Tôn Thất Thuyết Phường 3 Quận 4</div>
                <div style="font-size: 12px">Điện thoại: 0772818495</div>
            </div>
        </div>
    </div>
    <div class="col-md-12 text-center">
        <h2 style="font-weight: bold; font-size: 17px; color: red;">HOÁ ĐƠN BÁN HÀNG</h2>
        <div style="font-size: 12px">Ngày.....Tháng.....Năm.....</div>
    </div>

    <div class="text-center mt-2 mb-2" style="font-size: 16px;font-weight: bold">Thông Tin Vận Chuyển</div>
    <table class="table table-bordered table-hover">
        <thead>
        <tr align="center">
            <th width="130px">Tên người nhận</th>
            <th >Địa chỉ</th>
            <th width="100px">Số điện thoại</th>
            <th >Ghi chú</th>
        </tr>
        </thead>
        <tr align='center'>
            <th>
                @if ($donhang->HoTen==null)
                     {{$donhang->khachhang->HoTen}}
                @else
                    {{ "Tên 1: ".$donhang->HoTen}}<br/>
                    {{ "Tên 2: ".$donhang->khachhang->HoTen}}
                @endif
            </th>
            <th>
                @if ($donhang->DiaChi==null)
                    {{$donhang->khachhang->DiaChi}}
                @else
                    {{"Địa chỉ 1: ".$donhang->DiaChi}}<br/>
                    {{"Địa chỉ 2: ".$donhang->khachhang->DiaChi}}
                @endif
            </th>
            <th>
                @if ($donhang->SoDienThoai==null)
                    {{$donhang->khachhang->SoDienThoai}}
                @else
                   {{"Số điện thoại 1: ".$donhang->SoDienThoai}}<br/>
                    {{"Số điện thoại 2: ".$donhang->khachhang->SoDienThoai}}
                @endif
            </th>
            <th>
                    {{$donhang->GhiChu}}
            </th>
        </tr>
    </table>
    <div class="text-center mt-4 mb-2 mt-0" style="font-size: 16px;font-weight: bold">Chi Tiết Đơn Hàng</div>
    <table class='table table-bordered table-hover '>
        <thead>
        <tr align='center'>
            <th width="20px" >STT</th>
            <th>Tên</th>
            <th width="60px">Số lượng</th>
            <th>Giá</th>
            <th width="100px">Thành tiền</th>
        </tr>
        </thead>
        @foreach ($chitietdonhang as $key => $cthd)
            <?php
             $imei=explode('/', $cthd->IMEI);
            ?>
        <tr align='center'>
            <th class="text-center">{{$key+1}}</th>
            <th>
                {{$cthd->sanpham->Ten}}
            </th>
            <th class="text-center">{{$cthd->SoLuong}}</th>
            <th>
                {{number_format($cthd->Gia,0,',','.').'đ'}}
                <br>
                @if($cthd->Gia==0)
                    {{"( Sản phẩm tặng kèm khuyến mãi)"}}
                @endif
            </th>
            <th>
                {{number_format($cthd->SoLuong*$cthd->Gia,0,',','.').'đ'}}
            </th>
        </tr>
        @endforeach
        <tr>
            <th colspan="4">
                Tổng:
                <br>
                Khuyến mãi:
                <br>
                <br>
                Giảm giá:
                <br>
                Phí ship:
                <br>
                Thanh toán:
            </th>
            <th colspan="1">
                {{number_format($donhang->TongTien,0,',','.').'đ'}}
                <br>
                <?php
                $sum_sale=0;
                $name_sale=null;
                ?>
                @foreach ($chitietdonhang as $cthd1)
                    @if($cthd1->GiamGia!=null)
                        @if ($cthd1->TrangThai_KM==2)
                            <?php $name_sale='tặng'.' '.$sanpham->Ten;?>
                        @else
                            <?php $khuyenmai = $cthd1->GiamGia;
                            $price = $cthd1->sanpham->Gia * $cthd1->SoLuong;
                            $price_sale = ($price * $khuyenmai / 100);
                            $sum_sale += $price_sale;?>
                        @endif
                    @endif
                @endforeach
                {{number_format(-$sum_sale,0,',','.').'đ'}}
                <br>{{$name_sale}}
                <br>
                <?php
                $sum_coupon=0;
                if($donhang->idMaKM!=0){
                    $sotien_giamgia=$makm->theloaimakhuyenmai->GiaTri;
                    $sum_coupon=$sotien_giamgia;
                }
                ?>
                {{number_format(-$sum_coupon,0,',','.').'đ'}}
                <br>
                {{'free'}}
                <br>
                {{number_format($donhang->TongTien_DaGiam,0,',','.').'đ'}}
            </th>
        </tr>
    </table>
   <div class="row">
       <div class="col-md-12 text-right ml-2"><div style="font-size: 12px;font-style: italic">Ngày.....Tháng.....Năm.....</div></div>
   </div>
    <div class="row mb-4">
        <div class="col-md-6" style="width: 200px;text-align: center">
            <div style="font-weight: bold">Người Mua hàng</div>
            <p style="font-style: italic;font-size: 10px">( Ký, ghĩ rõ họ tên ) </p>
        </div>
        <div class="col-md-6" style="width: 170px; float: right;text-align: center">
            <div style="font-weight: bold">Người Bán Hàng</div>
            <p style="font-style: italic;font-size: 10px">( Ký, ghĩ rõ họ tên ) </p>
        </div>
    </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
