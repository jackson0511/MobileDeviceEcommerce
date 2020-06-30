<div class="box-filter slidebar-shop clearfix">
    <div class="btn-close"><a><i class="fa fa-times"></i></a></div>
    <form  action="" method="get" id="form_filter">
        <div class="row">
          @foreach($boloc as $bl)
             @if($bl->parent_id==0)
            <div class="col-lg-3">
                <h5 class="widget-title">{{$bl->Ten}}</h5>
                @foreach($bl->children as  $child)
                <div class="form-check form-inline mb-2 mr-2">
                    <input  type="radio"
                            class="form-check-input mr-2"
                             name=@if($bl->Ten=='Giá'){{"gia"}} @elseif($bl->Ten=='Dung Lượng'){{'dung_luong'}} @elseif($bl->Ten=='Sim'){{'sim'}}@else{{'filter'}} @endif
                             value="{{$child->Ten_KhongDau}}"
                             @if($gia==$child->Ten_KhongDau)
                                 {{'checked'}}
                             @endif
                            @if($dungluong==$child->Ten_KhongDau)
                                {{'checked'}}
                            @endif
                            @if($sim==$child->Ten_KhongDau)
                                {{'checked'}}
                            @endif
                            id="inlineFormCheck{{$child->id}}">
                    <label style="color: #337ab7; font-size: 14px" class="form-check-label" for="inlineFormCheck{{$child->id}}">
                        {{$child->Ten}}
                    </label>
                </div>
                 @endforeach
            </div>
             @endif
          @endforeach
{{--            <div class="col-lg-3">--}}
{{--                <h5 class="widget-title">Giá</h5>--}}
{{--                <div class="form-check form-inline mb-2 mr-2">--}}
{{--                    <input class="form-check-input mr-2"  type="checkbox" @if($gia==='tat-ca'){{'checked'}} @endif name="gia" value="tat-ca" id="inlineFormCheckPrice1">--}}
{{--                    <label style="color: #337ab7; font-size: 14px" class="form-check-label" for="inlineFormCheckPrice1">--}}
{{--                        Tất cả--}}
{{--                    </label>--}}
{{--                </div>--}}
{{--                <div class="form-check form-inline mb-2 mr-2">--}}
{{--                    <input class="form-check-input mr-2 sort"  type="checkbox" @if($gia=='5-10'){{'checked'}} @endif name="gia" value="5-10" id="inlineFormCheckPrice2">--}}
{{--                    <label style="color: #337ab7; font-size: 14px" class="form-check-label" for="inlineFormCheckPrice2">--}}
{{--                       5-10 Triệu--}}
{{--                    </label>--}}
{{--                </div>--}}
{{--                <div class="form-check form-inline mb-2 mr-2">--}}
{{--                    <input class="form-check-input mr-2 sort"  type="checkbox" @if($gia=='10-20'){{'checked'}} @endif name="gia" value="10-20" id="inlineFormCheckPrice3">--}}
{{--                    <label style="color: #337ab7; font-size: 14px" class="form-check-label" for="inlineFormCheckPrice3">--}}
{{--                        10-20 Triệu--}}
{{--                    </label>--}}
{{--                </div>--}}
{{--                <div class="form-check form-inline mb-2 mr-2">--}}
{{--                    <input class="form-check-input mr-2 sort"  type="checkbox" @if($gia=='20-30'){{'checked'}} @endif name="gia" value="20-30" id="inlineFormCheckPrice4">--}}
{{--                    <label style="color: #337ab7; font-size: 14px" class="form-check-label" for="inlineFormCheckPrice4">--}}
{{--                        20-30 Triệu--}}
{{--                    </label>--}}
{{--                </div>--}}
{{--                <div class="form-check form-inline mb-2 mr-2">--}}
{{--                    <input class="form-check-input mr-2 sort"  type="checkbox" @if($gia==='tren-30'){{'checked'}} @endif name="gia" value="tren-30" id="inlineFormCheckPrice5">--}}
{{--                    <label style="color: #337ab7; font-size: 14px" class="form-check-label" for="inlineFormCheckPrice5">--}}
{{--                        Trên 30 Triệu--}}
{{--                    </label>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-lg-3">--}}
{{--                <h5 class="widget-title">Dung lượng</h5>--}}
{{--                <div class="form-check form-inline mb-2 mr-2">--}}
{{--                    <input class="form-check-input mr-2"  type="checkbox"  @if($dungluong==='tat-ca'){{'checked'}} @endif name="dung_luong" value="tat-ca" id="inlineFormCheckCapacity1">--}}
{{--                    <label style="color: #337ab7; font-size: 14px" class="form-check-label" for="inlineFormCheckCapacity1">--}}
{{--                        Tất cả</label>--}}
{{--                </div>--}}
{{--                <div class="form-check form-inline mb-2 mr-2">--}}
{{--                    <input class="form-check-input mr-2 sort"  type="checkbox" @if($dungluong=='64'){{'checked'}} @endif name="dung_luong" value="64" id="inlineFormCheckCapacity2">--}}
{{--                    <label style="color: #337ab7; font-size: 14px" class="form-check-label" for="inlineFormCheckCapacity2">--}}
{{--                        64 GB--}}
{{--                    </label>--}}
{{--                </div>--}}
{{--                <div class="form-check form-inline mb-2 mr-2">--}}
{{--                    <input class="form-check-input mr-2 sort"  type="checkbox" @if($dungluong=='128'){{'checked'}} @endif name="dung_luong" value="128" id="inlineFormCheckCapacity3">--}}
{{--                    <label style="color: #337ab7; font-size: 14px" class="form-check-label" for="inlineFormCheckCapacity3">--}}
{{--                        128 GB--}}
{{--                    </label>--}}
{{--                </div>--}}
{{--                <div class="form-check form-inline mb-2 mr-2">--}}
{{--                    <input class="form-check-input mr-2 sort"  type="checkbox" @if($dungluong=='256'){{'checked'}} @endif name="dung_luong" value="256" id="inlineFormCheckCapacity4">--}}
{{--                    <label style="color: #337ab7; font-size: 14px" class="form-check-label" for="inlineFormCheckCapacity4">--}}
{{--                        256 GB--}}
{{--                    </label>--}}
{{--                </div>--}}
{{--                <div class="form-check form-inline mb-2 mr-2">--}}
{{--                    <input class="form-check-input mr-2 sort"  type="checkbox" @if($dungluong=='512'){{'checked'}} @endif name="dung_luong" value="512" id="inlineFormCheckCapacity5">--}}
{{--                    <label style="color: #337ab7; font-size: 14px" class="form-check-label" for="inlineFormCheckCapacity5">--}}
{{--                        512 GB--}}
{{--                    </label>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-lg-3">--}}
{{--                <h5 class="widget-title">Sim</h5>--}}
{{--                <div class="form-check form-inline mb-2 mr-2">--}}
{{--                    <input class="form-check-input mr-2"  type="checkbox" @if($sim==='tat-ca'){{'checked'}} @endif name="sim" value="tat-ca" id="inlineFormCheckSim1">--}}
{{--                    <label style="color: #337ab7; font-size: 14px" class="form-check-label" for="inlineFormCheckSim1">--}}
{{--                        Tất cả--}}
{{--                    </label>--}}
{{--                </div>--}}
{{--                <div class="form-check form-inline mb-2 mr-2">--}}
{{--                    <input class="form-check-input mr-2 sort"  type="checkbox" @if($sim=='1'){{'checked'}} @endif name="sim" value="1" id="inlineFormCheckSim2">--}}
{{--                    <label style="color: #337ab7; font-size: 14px" class="form-check-label" for="inlineFormCheckSim2">--}}
{{--                        1 Sim--}}
{{--                    </label>--}}
{{--                </div>--}}
{{--                <div class="form-check form-inline mb-2 mr-2">--}}
{{--                    <input class="form-check-input mr-2 sort"  type="checkbox" @if($sim=='2'){{'checked'}} @endif name="sim" value="2" id="inlineFormCheckSim3">--}}
{{--                    <label style="color: #337ab7; font-size: 14px" class="form-check-label" for="inlineFormCheckSim3">--}}
{{--                        2 Sim--}}
{{--                    </label>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>

    </form>
</div><!-- /.box-filter -->
<div class="shop-search clearfix">
    <form role="search" method="get" class="search-form" action="#">
        <label>
            <input type="search" class="search-field" placeholder="Searching …" value="" name="s">
        </label>
    </form>
</div><!-- /.top-serach -->
