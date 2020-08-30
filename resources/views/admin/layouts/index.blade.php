<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">
    <!-- App Favicon icon -->
    <link href="icon/ducthuan.png" rel="shortcut icon">
    <!-- App Title -->
    <title>Admin - Apple</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{ asset('') }}">

    <!-- DataTables -->
    <link href="admin/assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="admin/assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="admin/assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="admin/assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="admin/assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="admin/assets/plugins/datatables/dataTables.colVis.css" rel="stylesheet" type="text/css"/>
    <link href="admin/assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="admin/assets/plugins/datatables/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <!-- Ladda buttons css -->
    <link href="admin/assets/plugins/ladda-buttons/css/ladda-themeless.min.css" rel="stylesheet" type="text/css" />

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="admin/assets/plugins/morris/morris.css">

    <!-- Plugins css-->
{{--    <link href="admin/assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">--}}
{{--    <link href="admin/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">--}}
{{--    <link href="admin/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">--}}
{{--    <link href="admin/assets/plugins/clockpicker/css/bootstrap-clockpicker.min.css" rel="stylesheet">--}}
{{--    <link href="admin/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">--}}


    <link href="admin/assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />
    <link href="admin/assets/plugins/switchery/css/switchery.min.css" rel="stylesheet" />
    <link href="admin/assets/plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />
    <link href="admin/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="admin/assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
    <link href="admin/assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

    <link href="admin/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="admin/assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="admin/assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="admin/assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="admin/assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="admin/assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="admin/assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="admin/assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="admin/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="admin/assets/js/modernizr.min.js"></script>

</head>


<body>


<!-- Navigation Bar-->
<header id="topnav">
    @include('admin.layouts.header')
</header>
<!-- End Navigation Bar-->


<div class="wrapper">
    <div class="container">

        <!-- content -->
            @yield('content')
        <div id="loading" style="display: none">
            <img src="images/loading.gif"  alt="">
        </div>
        <div id="data_profile"></div>
        <!-- endcontent -->
        <!-- Footer -->
        <footer class="footer text-right">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6">
                        © {{date('Y')}}. by Developer Đức Thuận
                    </div>
                    <div class="col-xs-6">
                        <ul class="pull-right list-inline m-b-0">
                            <li>
                                <a href="#">About</a>
                            </li>
                            <li>
                                <a href="#">Help</a>
                            </li>
                            <li>
                                <a href="#">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer -->

    </div> <!-- end container -->
</div>
<!-- end wrapper -->



<!-- jQuery  -->
<script src="admin/assets/js/jquery.min.js"></script>
<script src="admin/assets/js/bootstrap.min.js"></script>
<script src="admin/assets/js/detect.js"></script>
<script src="admin/assets/js/fastclick.js"></script>
<script src="admin/assets/js/jquery.slimscroll.js"></script>
<script src="admin/assets/js/jquery.blockUI.js"></script>
<script src="admin/assets/js/waves.js"></script>
<script src="admin/assets/js/wow.min.js"></script>
<script src="admin/assets/js/jquery.nicescroll.js"></script>
<script src="admin/assets/js/jquery.scrollTo.min.js"></script>

<script src="admin/assets/plugins/peity/jquery.peity.min.js"></script>
<script src="admin/assets/plugins/waypoints/lib/jquery.waypoints.js"></script>
<script src="admin/assets/plugins/counterup/jquery.counterup.min.js"></script>

<script src="admin/assets/plugins/morris/morris.min.js"></script>
<script src="admin/assets/plugins/raphael/raphael-min.js"></script>

<script src="admin/assets/plugins/jquery-knob/jquery.knob.js"></script>



<!-- Parsly js -->
<script type="text/javascript" src="admin/assets/plugins/parsleyjs/parsley.min.js"></script>

<!-- App core js -->
<script src="admin/assets/js/jquery.core.js"></script>
<script src="admin/assets/js/jquery.app.js"></script>

<script src="admin/assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>

<script src="admin/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="admin/assets/plugins/datatables/dataTables.bootstrap.js"></script>

<script src="admin/assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="admin/assets/plugins/datatables/buttons.bootstrap.min.js"></script>
<script src="admin/assets/plugins/datatables/jszip.min.js"></script>
<script src="admin/assets/plugins/datatables/pdfmake.min.js"></script>
<script src="admin/assets/plugins/datatables/vfs_fonts.js"></script>
<script src="admin/assets/plugins/datatables/buttons.html5.min.js"></script>
<script src="admin/assets/plugins/datatables/buttons.print.min.js"></script>
<script src="admin/assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
<script src="admin/assets/plugins/datatables/dataTables.keyTable.min.js"></script>
<script src="admin/assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="admin/assets/plugins/datatables/responsive.bootstrap.min.js"></script>
<script src="admin/assets/plugins/datatables/dataTables.scroller.min.js"></script>
<script src="admin/assets/plugins/datatables/dataTables.colVis.js"></script>
<script src="admin/assets/plugins/datatables/dataTables.fixedColumns.min.js"></script>
<script src="admin/assets/plugins/select2/js/select2.js"></script>
<script src="admin/assets/pages/datatables.init.js"></script>
{{--picker--}}
<script src="admin/assets/plugins/moment/moment.js"></script>
<script src="admin/assets/plugins/timepicker/bootstrap-timepicker.js"></script>
<script src="admin/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="admin/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="admin/assets/plugins/clockpicker/js/bootstrap-clockpicker.min.js"></script>
<script src="admin/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="admin/assets/pages/jquery.form-pickers.init.js"></script>
<!-- ladda js -->
<script src="admin/assets/plugins/ladda-buttons/js/spin.min.js"></script>
<script src="admin/assets/plugins/ladda-buttons/js/ladda.min.js"></script>
<script src="admin/assets/plugins/ladda-buttons/js/ladda.jquery.min.js"></script>
{{--pusher--}}
<script src="https://js.pusher.com/4.4/pusher.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('.counter').counterUp({
            delay: 100,
            time: 1200
        });

        $(".knob").knob();

    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#loading").show();
        setTimeout(function() {
            $("#loading").hide();
        }, 1000);
        $('form').parsley();
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable').dataTable({
            processing: true,
            scrollY:        '50vh',
            "oLanguage":{
                "sProcessing":   "Đang xử lý...",
                "sLengthMenu":   "Xem _MENU_ mục",
                "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
                "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
                "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
                "sInfoFiltered": "(được lọc từ _MAX_ mục)",
                "sInfoPostFix":  "",
                "sSearch":       "Tìm:",
                "sUrl":          "",
                "oPaginate": {
                    "sFirst":    "Đầu",
                    "sPrevious": "Trước",
                    "sNext":     "Tiếp",
                    "sLast":     "Cuối"
                }
            },
            pageLength: 25
        });
    });
    TableManageButtons.init();

</script>
<script>
    $(document).ready(function () {
        function showNoti() {
            var notifications= notificationsWrapper.find('li.notification-list');
            let notifi=localStorage.getItem('notifi');
            if(notifi !=null) {
                notifi = $.parseJSON(notifi);
                notifi.sort((a,b)=>{
                    return b-a;
                });
                var newNotification='';
                $.each(notifi, function (key, value) {
                    newNotification += `<a href="admin/donhang/danhsach?order_id=${value}" class="list-group-item">
                                <div class="media">
                                    <div class="pull-left p-r-10">
                                        <em class="fa fa-bell-o noti-custom"></em>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="media-heading">New Order</h5>
                                        <p class="m-0">
                                            <small>Khách vừa mua đơn hàng với id là <span class="text-primary font-600">${value}</span></small>
                                        </p>
                                    </div>
                                </div>
                            </a>`;
                });
                notifications.html(newNotification)
            }
        }
        var notificationsWrapper     = $('.dropdown-menu-lg');
        var notificationsCountElem   = $('.navbar-c-items').find('a > span[data-count]');
        var notificationsCount       =parseInt(notificationsCountElem.data('count'));
        var notifications            = notificationsWrapper.find('li.notification-list');
        var shownotifi               = $(".icon-bell");
        var result                   =$("#ketqua-trungtam");
        //show notification old
            showNoti();
        //
        Pusher.logToConsole = true;
        var pusher = new Pusher('f69d9f56b41b786cfb23', {
            encrypted: true,
            cluster: "ap1"
        });
        // Subscribe to the channel we specified in our Laravel Event
        var channel = pusher.subscribe('notification-message');

        channel.bind('send-message', function(data) {
            //save notification
            let notis=localStorage.getItem('notifi');
            if (notis==null){
                arraynoti=new Array();
                arraynoti.push(JSON.stringify(data.order.id));
                localStorage.setItem('notifi',JSON.stringify(arraynoti));
            }else{
                notis=$.parseJSON(notis);
                if (notis.indexOf(JSON.stringify(data.order.id))==-1) {
                    notis.push(JSON.stringify(data.order.id));
                    localStorage.setItem('notifi', JSON.stringify(notis));
                }
            }
            //
            var existingNotifications = notifications.html();
            var newNotificationHtml = `
                            <a href="admin/donhang/danhsach?order_id=`+JSON.stringify(data.order.id)+`" class="list-group-item">
                                <div class="media">
                                    <div class="pull-left p-r-10">
                                        <em class="fa fa-bell-o noti-custom"></em>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="media-heading">New Order</h5>
                                        <p class="m-0">
                                            <small>Khách vừa mua đơn hàng với id là <span class="text-primary font-600">`+JSON.stringify(data.order.id)+`</span></small>
                                        </p>
                                    </div>
                                </div>
                            </a>
        `;
            notifications.html(newNotificationHtml+existingNotifications);

            notificationsCount += 1;
            notificationsCountElem.attr('data-count', notificationsCount);
            notificationsCountElem.text(notificationsCount);
            notificationsWrapper.find('li.notifi-title > span').text('New '+notificationsCount);
        });

        //reset count notification
        shownotifi.click(function () {
            notificationsCount=0;
            notificationsCountElem.attr('data-count', notificationsCount);
            notificationsCountElem.text(notificationsCount);
        });
        //

        //reload phieu trung tam
        var channel1 = pusher.subscribe('notification-warrantly');
        channel1.bind('reload-page', function(data) {
            if(data.data.message==='success'){
                showApple();
            }
        });
        function showApple() {
            $.ajax({
                url   : 'admin/phieutrungtam/show',
                type  : 'GET',
                async : true,
                success : function(data){
                   result.html(data);

                    $(".view-phieubaohanh").click(function () {
                        var id=$(this).attr('data-key');
                        $("#modal").modal('show');
                        $(".idbaohanh").text(id);
                        $.ajax({
                            method: "POST",
                            url: 'admin/phieubaohanh/show_chitiet_baohanh',
                            data: {
                                id:id,
                            },
                            success: function (data) {
                                if(data!=null) {
                                    $(".ketqua").html(data);
                                }
                            }
                        });
                    });
                }
            });
        }
    });

</script>

{{--ckeditor--}}
<script src="admin/ckeditor/ckeditor.js"></script>

@yield('script')
@include('scripts.script_profile');
</body>
</html>
