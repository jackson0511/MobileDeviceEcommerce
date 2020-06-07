 <div class="box-filter slidebar-shop clearfix">
        <div class="btn-close"><a><i class="fa fa-times"></i></a></div>
{{--        <div class="widget widget-sort-by">--}}
{{--            <h5 class="widget-title">--}}
{{--                Sort By--}}
{{--            </h5>--}}
{{--            <ul>--}}
{{--                <li><a href="#" class="active">Default</a></li>--}}
{{--                <li><a href="#">Giá: Tăng dần</a></li>--}}
{{--                <li><a href="#">Giá: Giảm dần</a></li>--}}
{{--            </ul>--}}
{{--        </div><!-- /.widget-sort-by -->--}}
        <div class="widget widget-price">
            <h5 class="widget-title">Giá</h5>
            <ul>
                <li><a href="danhsachsanphamtheoboloc?gia=tatca" class="@if($gia==='tatca'){{'active'}} @endif">Tất cả</a></li>
                <li><a href="danhsachsanphamtheoboloc?gia=5-10"  class="@if($tu==5 && $den==10){{'active'}} @endif">5-10 Triệu</a></li>
                <li><a href="danhsachsanphamtheoboloc?gia=10-15" class="@if($tu==10 && $den==15){{'active'}} @endif">10-15 Triệu</a></li>
                <li><a href="danhsachsanphamtheoboloc?gia=15-20" class="@if($tu==15 && $den==20){{'active'}} @endif">15-20 Triệu</a></li>
                <li><a href="danhsachsanphamtheoboloc?gia=20-30" class="@if($tu==20 && $den==30){{'active'}} @endif">20-30 Triệu</a></li>
                <li><a href="danhsachsanphamtheoboloc?gia=30-50" class="@if($tu=30 && $den==100){{'active'}} @endif" >Trên 30 Triệu</a></li>

            </ul>
        </div><!-- /.widget -->
        <div class="widget widget-color">
            <h5 class="widget-title">
             Dung Lượng
            </h5>
         <ul >
             <li><a  href="danhsachsanphamtheoboloc?dungluong=tatca" class="@if($dungluong==='tatca'){{'active'}} @endif" >Tất cả</a></li>
            <li><a  href="danhsachsanphamtheoboloc?dungluong=64" class="@if($dungluong==64){{'active'}} @endif" >64GB</a></li>
            <li><a href="danhsachsanphamtheoboloc?dungluong=128" class="@if($dungluong==128){{'active'}} @endif"> 128GB</a></li>
            <li><a href="danhsachsanphamtheoboloc?dungluong=256" class="@if($dungluong==256){{'active'}} @endif">256GB </a></li>
            <li><a href="danhsachsanphamtheoboloc?dungluong=512" class="@if($dungluong==512){{'active'}} @endif">512GB</a></li>
        </ul>
        </div><!-- /.widget-color -->
        <div class="widget widget-size">
            <h5 class="widget-title">Sim</h5>
            <ul>
                <li><a href="danhsachsanphamtheoboloc?sim=tatca" class="@if($sim==='tatca'){{'active'}} @endif">Tất cả</a></li>
                <li><a href="danhsachsanphamtheoboloc?sim=1" class="@if($sim==1){{'active'}}@endif">1 Sim</a></li>
                <li><a href="danhsachsanphamtheoboloc?sim=2" class="@if($sim==2){{'active'}}@endif">2 Sim</a></li>
            </ul>
        </div><!-- /.widget -->
    </div><!-- /.box-filter -->
    <div class="shop-search clearfix">
        <form role="search" method="get" class="search-form" action="#">
            <label>
                <input type="search" class="search-field" placeholder="Searching …" value="" name="s">
            </label>
        </form>
    </div><!-- /.top-serach -->
