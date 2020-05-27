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

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="admin/assets/plugins/morris/morris.css">

    <!-- Plugins css-->
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
        <!-- endcontent -->
        <!-- Footer -->
        <footer class="footer text-right">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6">
                        © 2020. All rights reserved.
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
        $('form').parsley();
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable').dataTable();
        $('#datatable-keytable').DataTable({keys: true});
        $('#datatable-responsive').DataTable();
        $('#datatable-colvid').DataTable({
            "dom": 'C<"clear">lfrtip',
            "colVis": {
                "buttonText": "Change columns"
            }
        });
        $('#datatable-scroller').DataTable({
            ajax: "admin/assets/plugins/datatables/json/scroller-demo.json",
            deferRender: true,
            scrollY: 380,
            scrollCollapse: true,
            scroller: true
        });
        var table = $('#datatable-fixed-header').DataTable({fixedHeader: true});
        var table = $('#datatable-fixed-col').DataTable({
            scrollY: "300px",
            scrollX: true,
            scrollCollapse: true,
            paging: false,
            fixedColumns: {
                leftColumns: 1,
                rightColumns: 1
            }
        });
    });
    TableManageButtons.init();

</script>
{{--ckeditor--}}
<script src="admin/ckeditor/ckeditor.js"></script>

@yield('script')
</body>
</html>
