<!doctype html>
<html lang="vi33">
<head>
    <title>Invoice</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid" style="border:2px solid rgb(74, 204, 243);">
    <div class="row mt-5">
        <div class="col-md-3">
            <h4 class="text-center"><img src="assets/images/logo_dark.png" alt="velonic"></h4>
        </div>
        <div class="col-md-9">
            <div class="title-right">
                <h2 style="font-weight: bold; color: red;">CÔNG TY THHH HỆ THỐNG APPLE</h2>
                <p>Địa chỉ: 270 Tôn Thất Thuyết Phường 3 Quận 4</p>
                <p>Điện thoại: 0772818495</p>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12 text-center">
            <h2 style="font-weight: bold; color: red;">HOÁ ĐƠN BÁN HÀNG</h2>
        </div>
        <div class="col-md-12 text-center">
            <p>Ngày.....Tháng.....Năm.....</p>
        </div>
    </div>
    <h2 class='text-center'>Thông tin vận chuyển</h2>
    <table class='table table-striped table-bordered table-hover'>
        <thead>
        <tr align='center'>
            <th>Tên người nhận</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Ghi chú</th>
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
     <h2 class='text-center'>Chi tiết đơn hàng</h2>
    <table class='table table-striped table-bordered table-hover '>
        <thead>
        <tr align='center'>
            <th>STT</th>
            <th>Tên</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Thành tiền</th>
        </tr>
        </thead>";
        @foreach ($chitietdonhang as $key => $cthd)
            <?php
             $imei=explode('/', $cthd->IMEI);
            ?>
        <tr align='center'>
            <th>{{$key+1}}</th>
            <th>
                {{$cthd->sanpham->Ten}}
            </th>
            <th>{{$cthd->SoLuong}}</th>
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
            <th colspan="4"></th>
            <th colspan='2'>
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
            <th colspan="2">
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
                {{number_format(-$sum_sale,0,',','.').'đ'.'</br>'.$name_sale}}
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

</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
