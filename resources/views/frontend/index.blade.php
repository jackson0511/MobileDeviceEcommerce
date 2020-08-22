
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title>Đức Thuận Apple</title>

    <meta name="author" content="themesflat.com">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{ asset('') }}">
    <!-- Bootstrap  -->
    <link rel="stylesheet" type="text/css" href="stylesheets/bootstrap.css" >

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="stylesheets/style.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/responsive.css">

    <!-- Colors -->
    <link rel="stylesheet" type="text/css" href="stylesheets/colors/color1.css" id="colors">

    <!-- Animation Style -->
    <link rel="stylesheet" type="text/css" href="stylesheets/animate.css">

    <!-- Favicon and touch icons  -->
    <link href="icon/ducthuan.png" rel="shortcut icon">
    <style>
        .page-item.active .page-link{
            background: #f63440;
            border-color: #f63440;
            color: #eee;

        }
        .page-item{
            margin-left: 5px;
        }
        .page-link{
            color: #6e6e6e;
        }
        .page-item .page-link:hover{
            color: #fff !important;
            background: #f63440;
        }

    </style>

</head>
<body class="header_sticky header-style-1 topbar-style-1 has-menu-extra">
<!-- Preloader -->
<div id="loading-overlay">
    <div class="loader"></div>
</div>

<!-- Boxed -->
<div class="boxed">
    <div id="site-header-wrap">
        @include ('frontend.subpage.header')
    </div><!-- /#site-header-wrap -->
    <!-- content -->
    @yield('content')
<!-- end content -->
    @include ('frontend.subpage.footer')

<!-- Go Top -->
    <a class="go-top">
        <i class="fa fa-chevron-up"></i>
    </a>
    <!-- show coupon -->
    <a class="show-coupon-index">
        <i class="fa fa-plus"></i>
    </a>

</div>
<!-- Javascript -->

<script src="javascript/jquery.min.js"></script>

<script src="javascript/tether.min.js"></script>
<script src="javascript/bootstrap.min.js"></script>
<script src="javascript/jquery.easing.js"></script>
<script src="javascript/parallax.js"></script>
<script src="javascript/jquery-waypoints.js"></script>
<script src="javascript/jquery-countTo.js"></script>
<script src="javascript/jquery.countdown.js"></script>
<script src="javascript/jquery.flexslider-min.js"></script>
<script src="javascript/images-loaded.js"></script>
<script src="javascript/jquery.isotope.min.js"></script>
<script src="javascript/magnific.popup.min.js"></script>
<script src="javascript/jquery.hoverdir.js"></script>
<script src="javascript/owl.carousel.min.js"></script>
<script src="javascript/equalize.min.js"></script>
<script src="javascript/gmap3.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIEU6OT3xqCksCetQeNLIPps6-AYrhq-s&region=GB"></script>
<script src="javascript/jquery-ui.js"></script>

<script src="javascript/jquery.cookie.js"></script>
<script src="javascript/main.js"></script>

<!-- Revolution Slider -->
<script src="rev-slider/js/jquery.themepunch.tools.min.js"></script>
<script src="rev-slider/js/jquery.themepunch.revolution.min.js"></script>
<script src="javascript/rev-slider.js"></script>
<!-- Load Extensions only on Local File Systems ! The following part can be removed on Server for On Demand Loading -->
<script src="rev-slider/js/extensions/revolution.extension.actions.min.js"></script>
<script src="rev-slider/js/extensions/revolution.extension.carousel.min.js"></script>
<script src="rev-slider/js/extensions/revolution.extension.kenburn.min.js"></script>
<script src="rev-slider/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script src="rev-slider/js/extensions/revolution.extension.migration.min.js"></script>
<script src="rev-slider/js/extensions/revolution.extension.navigation.min.js"></script>
<script src="rev-slider/js/extensions/revolution.extension.parallax.min.js"></script>
<script src="rev-slider/js/extensions/revolution.extension.slideanims.min.js"></script>
<script src="rev-slider/js/extensions/revolution.extension.video.min.js"></script>


<script>
    $(document).ready(function(){
        var result=$("#ketqua");
        result.hide()
        $("#tukhoa").keyup(function(){
            var tukhoa=$(this).val();
            if(tukhoa==''){
                result.hide()
                return;
            }
            $.ajax({
                method: "POST",
                url: 'ajax/timkiem',
                data: {
                    tukhoa:tukhoa,
                },
                success: function (data) {
                    if(data!=null) {
                        result.show();
                        $("#ketqua").html(data);
                    }
                }
            });
        });
    });
</script>
<script>
    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        checkProduct=false;
        $(document).on('scroll',function(){
            if($(window).scrollTop()>500 && checkProduct==false){
                checkProduct=true;
                let products=localStorage.getItem('products');
                products=$.parseJSON(products);
                if(products.length>0){
                    $.post("ajax/sanphamview/"+products,function(result){
                        $("#view").html(result);
                    });
                }
            }
        });
    });
    //filter
    $(document).ready(function () {
        var arr_value=[];
        var result='';
        $("#form_filter input[type=radio]").click(function () {
            // $("[name=gia]:first").prop('checked', false);
            // $("[name=dung_luong]:first").prop('checked', false);
            // $("[name=sim]:first").prop('checked',false);
            var check=$(this).is(':checked');
           //  if(check){
           //      arr_value.push(value);
           //  }else{
           //      var index=arr_value.indexOf(value);
           //      arr_value.splice(index,1);
           //  }
           //  let filter=localStorage.getItem('filter');
           //  if(filter==null){
           //      localStorage.setItem('filter',JSON.stringify(arr_value));
           //  }else{
           //      //chuyen ve mang
           //      filter=$.parseJSON(filter);
           //      if(filter.indexOf(value)==-1)
           //      {
           //          filter.push(value);
           //          localStorage.setItem('filter',JSON.stringify(filter));
           //      }else{
           //          filter.splice(value,1);
           //          localStorage.setItem('filter',JSON.stringify(filter));
           //      }
           //  }
            $("#form_filter").submit();
            // $.ajax({
            //     method: "POST",
            //     url: 'ajax/product-filter',
            //     data: {
            //         arr_value:arr_value,
            //     },
            //     success: function (data) {
            //         if(data!=null) {
            //             var data_result=JSON.parse(data);
            //             $.each(data_result.data,function (k,v) {
            //                 result+='<li class="product-item">\n' +
            //                 '             <div class="product-thumb clearfix">\n' +
            //                 '                    <a href="chitietsanpham/'+v.id+'/'+v.Ten_KhongDau+'.html">\n' +
            //                 '                    <img src="upload/sanpham/'+v.Hinh+'" alt="image">\n' +
            //                 '                    </a>\n' +
            //                 '              </div>\n' +
            //                 '              <div class="product-info clearfix">\n' +
            //                 '                    <span class="product-title">'+v.Ten+'</span>\n' +
            //                 '                    <div class="price">\n' +
            //                 '                         <ins>\n' +
            //                 '                            <span class="amount">'+v.Gia+'</span>\n' +
            //                 '                         </ins>\n' +
            //                 '                     </div>\n' +
            //                 '              </div>\n' +
            //                 '                     <div class="add-to-cart text-center">\n' +
            //                 '                        <a href="themgiohang/'+v.id+'">Thêm giỏ hàng</a>\n' +
            //                 '                     </div>\n' +
            //                 '                         <a href="#" class="like"><i class="fa fa-heart-o"></i></a>\n' +
            //                 '        </li>';
            //             });
            //             $("#kq").html(result);
            //         }
            //     }
            // });
        });
    });
    //sort
    $(document).ready(function () {
        $("#sort").change(function () {
            $("#form_sort").submit();
        });
    });
</script>
{{--   <script>--}}
{{--  function startTime() {--}}
{{--      var today = new Date();--}}
{{--      var h = today.getHours();--}}
{{--      var m = today.getMinutes();--}}
{{--      var s = today.getSeconds();--}}
{{--      m = checkTime(m);--}}
{{--      s = checkTime(s);--}}

{{--      /* Đặt phần tử của bạn tại đây */--}}
{{--      document.getElementById('clock').innerHTML =--}}
{{--      h + ":" + m + ":" + s;--}}
{{--      var t = setTimeout(startTime, 500);--}}
{{--  }--}}
{{--  function checkTime(i) {--}}
{{--          if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10--}}
{{--          return i;--}}
{{--      }--}}
{{--      document.querySelector('body').addEventListener("load", startTime());--}}

{{--  </script>--}}

@yield('script')

</body>
</html>
