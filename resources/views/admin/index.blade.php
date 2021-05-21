@extends('admin.layouts.index')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="widget-bg-color-icon card-box fadeInDown animated">
                <div class="bg-icon bg-icon-info pull-left">
                    <i class="md md-attach-money text-info"></i>
                </div>
                <div class="text-right">
                    <h3 class="text-dark"><b class="counter">{{number_format($tongtien)}}</b></h3>
                    <p class="text-muted">Tổng danh thu</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="widget-bg-color-icon card-box">
                <div class="bg-icon bg-icon-pink pull-left">
                    <i class="md md-add-shopping-cart text-pink"></i>
                </div>
                <div class="text-right">
                    <h3 class="text-dark"><b class="counter">{{count($donhang)}}</b></h3>
                    <p class="text-muted">Tổng đơn hàng</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="widget-bg-color-icon card-box">
                <div class="bg-icon bg-icon-purple pull-left">
                    <i class="md md-account-box text-purple"></i>
                </div>
                <div class="text-right">
                    <h3 class="text-dark">{{count($khachhang)}}</h3>
                    <p class="text-muted">Khách hàng</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="widget-bg-color-icon card-box">
                <div class="bg-icon bg-icon-success pull-left">
                    <i class="md md-phone-android text-success"></i>
                </div>
                <div class="text-right">
                    <h3 class="text-dark"><b class="counter">{{count($sanpham)}}</b></h3>
                    <p class="text-muted">Sản phẩm</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-5">
            <div class="card-box">
                <div class="row">
                    <div class="col-md-8"><h4 class="text-dark header-title m-t-0 m-b-30">Top sản phẩm bán chạy trong tháng</h4></div>
                    <div class="col-md-4">
                        <div  id="report-time">
                            <select class="form-control" name="months-report" id="months-report" data-width="100%">
                                <option selected value="this_month">Tháng này</option>
                                @foreach($data_month as $month)
                                    <option value="{{$month['id']}}">{{$month['value']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div id="container1"></div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card-box">
                <h4 class="text-dark header-title m-t-0 m-b-30">Biểu đồ doanh thu ngày/tuần/tháng/năm</h4>
                <div id="container2"></div>
            </div>
        </div>
    <!-- end row -->
    </div>

    <div class="row">

        <div class="col-lg-12">
            <div class="card-box">
                <a class="pull-right btn btn-default btn-sm waves-effect waves-light">View All</a>
                <h4 class="text-dark header-title m-t-0">Đơn hàng mới</h4>
                <div class="table-responsive">
                    <table class="table table-actions-bar m-b-0 table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Khách hàng</th>
                            <th>Tổng tiền</th>
                            <th>Tổng tiền đã giảm</th>
                            <th>Trạng thái</th>
                            <th >Thời gian</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($donhang_new as $dh)
                            <tr>
                                <td>{{$dh->id}}</td>
                                <td>{{$dh->khachhang->HoTen}}</td>
                                <td>{{number_format($dh->TongTien).'đ'}}</td>
                                <td>{{number_format($dh->TongTien_DaGiam).'đ'}}</td>
                                <td>
                                    <a class="btn btn-xs
                                   @if($dh->TrangThai==0)
                                    {{'btn-danger'}}
                                    @elseif($dh->TrangThai==4)
                                    {{'btn-danger'}}
                                    @else
                                    {{'btn-default'}}
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

                                    </a>
                                </td>
                                <td>{{$dh->created_at->format('d-m-Y')}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!-- end col -->

    </div>
    <!-- end row -->
@endsection
@section('script')
    <script src="admin/assets/pages/jquery.dashboard.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://code.highcharts.com/modules/funnel.js"></script>
    <script>
        $("#months-report").select2();
        // Build the chart
        let data1="{{$dataProduct}}";
        datachart1=JSON.parse(data1.replace(/&quot;/g,'"'));
        Highcharts.chart('container1', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Biểu đồ top sản phẩm bán chạy trong tháng'
            },
            tooltip: {
                pointFormat: '{point.y:.1f}Cái'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Brands',
                colorByPoint: true,
                data: datachart1
            }]
        });
        // Create the chart
        let data2="{{$dataMoney}}";
        datachart2=JSON.parse(data2.replace(/&quot;/g,'"'));

        //chitiet
        let dt="{{$dataChitiet}}";
        let dt1="{{$dataChitietNam}}";
        datamonth=JSON.parse(dt.replace(/&quot;/g,'"'));
        datayear=JSON.parse(dt1.replace(/&quot;/g,'"'));
        Highcharts.chart('container2', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Biểu đồ doanh thu ngày/tuần/tháng/năm'
            },

            accessibility: {
                announceNewData: {
                    enabled: true
                }
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Mức độ'
                }

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y:.1f}VNĐ'
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
            },

            series: [
                {
                    name: "Browsers",
                    colorByPoint: true,
                    data: datachart2
                }
            ],
            drilldown: {
                series: [

                    {
                        name: "Doanh thu tháng",
                        id: "Doanh thu tháng",
                        data: datamonth
                    },
                    {
                        name: "Doanh thu năm",
                        id: "Doanh thu năm",
                        data: datayear
                    },


                ]
            }
        });
        $('select[name="months-report"]').on('change', function() {
            $("#loading").show();
            init_dashboard();
        });
        function init_dashboard() {
            var report_months = $('select[name="months-report"]').val();
            dataString = {
                report_months: report_months,
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            };
            $.post('admin/dashboard/', dataString, function (response) {
                response = JSON.parse(response);

                Highcharts.chart('container1', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: 'Biểu đồ top sản phẩm bán chạy trong tháng'
                    },
                    tooltip: {
                        pointFormat: '{point.y:.1f}Cái'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: false
                            },
                            showInLegend: true
                        }
                    },
                    series: [{
                        name: 'Brands',
                        colorByPoint: true,
                        data: response.dataProduct
                    }]
                });
                setTimeout(function() {
                    $("#loading").hide();
                }, 500);
            });
        }
    </script>
@endsection
