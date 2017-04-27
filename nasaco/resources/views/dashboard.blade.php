@extends('layouts.home',['activemenuitem'=>'dashboard'])

@push('styles')
    <link rel="stylesheet" href="/tooltipster/dist/css/tooltipster.bundle.min.css" type="text/css" />
    <link rel="stylesheet" href="/tooltipster/dist/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-punk.min.css" type="text/css" />
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <link rel="stylesheet" href="css/default.css" type="text/css"></link>
@endpush

@section('content-header')
    <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
@endsection

@section('content')
    <div style="display:none" id="loading-dashboard" class="overlay">
        <div class='uil-default-css' style='transform:scale(0.53);margin:auto;height: 50px;'>
            <div style='top:80px;left:93px;width:14px;height:40px;background:#00b2ff;-webkit-transform:rotate(0deg) translate(0,-60px);transform:rotate(0deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#00b2ff;-webkit-transform:rotate(30deg) translate(0,-60px);transform:rotate(30deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#00b2ff;-webkit-transform:rotate(60deg) translate(0,-60px);transform:rotate(60deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#00b2ff;-webkit-transform:rotate(90deg) translate(0,-60px);transform:rotate(90deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#00b2ff;-webkit-transform:rotate(120deg) translate(0,-60px);transform:rotate(120deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#00b2ff;-webkit-transform:rotate(150deg) translate(0,-60px);transform:rotate(150deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#00b2ff;-webkit-transform:rotate(180deg) translate(0,-60px);transform:rotate(180deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#00b2ff;-webkit-transform:rotate(210deg) translate(0,-60px);transform:rotate(210deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#00b2ff;-webkit-transform:rotate(240deg) translate(0,-60px);transform:rotate(240deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#00b2ff;-webkit-transform:rotate(270deg) translate(0,-60px);transform:rotate(270deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#00b2ff;-webkit-transform:rotate(300deg) translate(0,-60px);transform:rotate(300deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#00b2ff;-webkit-transform:rotate(330deg) translate(0,-60px);transform:rotate(330deg) translate(0,-60px);border-radius:10px;position:absolute;'>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" >
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-filter" aria-hidden="true"></i>
                    <h3 class="box-title">Lọc theo ngày</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class='col-md-12'>
                           @include('dashboard.time-picker')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="box box-solid box-height-220 box-type-1">
                <div class="overlay display-none" id="loading-1">
                    @include('dashboard.loading')
                </div>
                <div class="box-header">
                    <h5 class="box-title">TỔNG XUẤT F1 + FA</h5>
                </div>
                <div class="box-body">
                    <div style="margin: auto; width: 120px; height: 120px; margin-top: -15px; margin-bottom: -15px;">
                        <div id="gauge-report"></div>
                    </div>
                    <hr style="margin-bottom: 5px;">
                    <b id="tong_xuat_f1_fa" style="margin: auto; font-size: 26px"></b>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box box-solid box-height-220">
                <div class="overlay display-none" id="loading-2">
                    @include('dashboard.loading')
                </div>
                <div class="box-body">
                    <table  class="table table-type-1">
                        <thead>
                            <tr>
                                <th></th>
                                <th>F1</th>
                                <th>F2</th>
                                <th>FA</th>
                            </tr>
                        </thead>
                        <tbody id="table_1">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="box box-solid box-height-220">
                <div class="overlay display-none" id="loading-3">
                    @include('dashboard.loading')
                </div>
                <div class="box-body">
                    <table  class="table table-type-1">
                        <thead>
                            <tr>
                                <th></th>
                                <th>E</th>
                                <th>G</th>
                            </tr>
                        </thead>
                        <tbody id="table_2">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="box box-solid box-height-220">
                <div class="overlay display-none" id="loading-4">
                    @include('dashboard.loading')
                </div>
                <div class="box-body">
                    <table class="table table-type-1">
                        <thead>
                            <tr>
                                <th></th>
                                <th>F</th>
                                <th>E</th>
                                <th>G</th>
                            </tr>
                            <tr>
                                <td></td>
                                <td>QYND PRO</td>
                                <td>QUE THỬ PH</td>
                                <td>BAO CAO SU</td>
                            </tr>
                        </thead>
                        <tbody id="table_3">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-solid box-height-260 box-type-1 position-container">
                        <div class="overlay display-none" id="loading-5">
                            @include('dashboard.loading')
                        </div>
                        <div class="box-header">
                            <h5 class="box-title">TỈNH THÀNH</h5>
                            <div class="top-right">
                                <button onclick="dashboard.clearSelected('list-provice')" class="btn btn-xs"><i class="fa fa-times" aria-hidden="true"></i></button>
                                <button onclick="dashboard.fillData()" class="btn btn-xs btn-success"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <div class="box-body" style="height: 200px;overflow-y: scroll; padding-top: 0;">
                            <table  id="list-provice" class="table-select" style="margin: 5px auto; font-size: 17px; width: 100%;">

                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box box-solid box-height-260 box-type-1 position-container">
                        <div class="box-header">
                            <h5 class="box-title">NHÓM HÀNG</h5>
                            <div class="top-right">
                                <button onclick="dashboard.clearSelected('list-type')" class="btn btn-xs"><i class="fa fa-times" aria-hidden="true"></i></button>
                                <button onclick="dashboard.fillData()" class="btn btn-xs btn-success"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <table id="list-type" class="table-select" style="font-size: 26px; margin: auto; width: 100%">
                                <tr data-value='F1'>
                                    <td>F1</td>
                                </tr>
                                <tr data-value='F2'>
                                    <td>F2</td>
                                </tr>
                                <tr data-value='FA'>
                                    <td>FA</td>
                                </tr>
                                <tr data-value='E'>
                                    <td>E</td>
                                </tr>
                                <tr data-value='G'>
                                    <td>G</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-solid box-height-260" style="position: relative;">
                        <div class="overlay display-none" id="loading-6">
                            @include('dashboard.loading')
                        </div>
                        <div class="report-title">F1</div>
                        <div id="report-f1-container" class="box-body">

                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box box-solid box-height-260" style="position: relative;">
                        <div class="overlay display-none" id="loading-8">
                            @include('dashboard.loading')
                        </div>
                        <div class="report-title">FA</div>
                        <div id="report-fa-container" class="box-body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box box-solid" style="width: 100%; height: 540px;">
                <div class="overlay display-none" id="loading-7">
                    @include('dashboard.loading')
                </div>
                <div id="geochart-colors" style="width: 100%; height: 100%;"></div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="box box-solid box-height-280">

                <div class="box-body">
                    <img src="img/img.jpg" alt="logo" style="width: 100%; height: 260px;">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-solid box-height-280" style="position: relative;">
                <div class="overlay display-none" id="loading-9">
                    @include('dashboard.loading')
                </div>
                <div class="report-title">Cơ cấu hàng theo tỉnh</div>
                <div class="box-body">
                    <div id="report-3-container" style="overflow-y : scroll; position: relative; margin-top:20px; height:230px;">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-solid box-height-280" style="position: relative;">
                <div class="overlay" id="loading-10">
                    @include('dashboard.loading')
                </div>
                <div class="report-title">Cơ cấu hàng theo nhóm</div>
                <div class="box-body">
                    <div id="report-4-container" style="width:100%;padding:30px 0px">

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts')
    <script src="https://www.amcharts.com/lib/3/ammap.js"></script>
    <script src="https://www.amcharts.com/lib/3/maps/js/vietnamLow.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="tooltipster/dist/js/tooltipster.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="js/DaEvent.js"></script>
    <script src="js/DaDashboard.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="js/dashboard.js"></script>

    <script>
        axios.get('/api/user')
            .then(data => {
                let role = data.data.roles[0].order;
                if(role == 1) {
                    $('#home-db').removeClass('display-none');
                }
            }).catch(error => {
                console.log(error);
            })
        window.Controller = window.Controller || {};
        var controller = window.Controller;
        var thisYear = (new Date()).getFullYear();
        var start = new Date("1/1/" + thisYear);
        var defaultStart = moment(start.valueOf());
        controller.DateFilter = { startTime: defaultStart.format('YYYY-MM-DD'), endTime: moment().format('YYYY-MM-DD') };
        $(function () {

            $('#date-range-picker').daterangepicker({
                "ranges": {
                    "Hôm nay": [
                        moment(),
                        moment()
                    ],
                    "Hôm qua": [
                        moment().subtract(1, 'days'),
                        moment().subtract(1, 'days')
                    ],
                    "Bảy ngày trước": [
                        moment().subtract(7, 'days'),
                        moment()
                    ],
                    "Tháng": [
                        moment().startOf('month'),
                         moment()
                    ],
                    "Quý": [
                        moment().startOf('quarter').fromNow(),
                        moment()
                    ]
                },
                "alwaysShowCalendars": true,
                "startDate": defaultStart,
                "endDate": moment(),
                "opens": "left"
            }, function(start, end, label) {
                controller.DateFilter.startTime = start.format('YYYY-MM-DD');
                controller.DateFilter.endTime = end.format('YYYY-MM-DD');
            })
        });
    </script>
    <script>
        var isLoadGoogleChart = false;
        var dashboard = new window.Controller.Dashboard();
        $( document ).ready(function() {
            $('#change_daterange').click(function () {
                dashboard.getData();
            });
        });

    </script>

@endpush
