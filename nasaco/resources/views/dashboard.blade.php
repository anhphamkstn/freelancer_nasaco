@extends('layouts.app',['activemenuitem'=>'dashboard'])

@section('content')
    <div class="row">
        <div class="col-md-12" >
            @include('dashboard.time-picker')
        </div>
        <div class="col-md-3">
            <div class="box box-solid box-height-220 box-type-1">
                <div class="box-header">
                    <h5 class="box-title">TỔNG XUẤT F1 + FA</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box box-solid box-height-220">
                <div class="box-body">
                    <table class="table table-type-1">
                        <thead>
                            <tr>
                                <th></th>
                                <th>F1</th>
                                <th>F2</th>
                                <th>FA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>TỔNG XUẤT</td>
                                <td>13.907</td>
                                <td>10.901</td>
                                <td>360</td>
                            </tr>
                            <tr>
                                <td>THANH TOÁN</td>
                                <td>6.907</td>
                                <td>0</td>
                                <td>200</td>
                            </tr>
                            <tr>
                                <td>CÒN LẠI</td>
                                <td>7000</td>
                                <td></td>
                                <td>100</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="box box-solid box-height-220">
                <div class="box-body">
                    <table class="table table-type-1">
                        <thead>
                            <tr>
                                <th></th>
                                <th>E</th>
                                <th>G</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td>6.972</td>
                                <td>358</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>6020</td>
                                <td>58</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>752</td>
                                <td>300</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-solid box-height-220">
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
                        <tbody>
                            <tr>
                                <td>TỔNG NHẬP</td>
                                <td>6.972</td>
                                <td>358</td>
                                <td>6.972</td>
                            </tr>
                            <tr>
                                <td>TỔNG XUẤT</td>
                                <td>6020</td>
                                <td>58</td>
                                <td>697</td>
                            </tr>
                            <tr>
                                <td>TỒN</td>
                                <td>752</td>
                                <td>300</td>
                                <td>752</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-solid box-height-260 box-type-1">
                        <div class="box-header">
                            <h5 class="box-title">TỈNH THÀNH</h5>
                        </div>
                        <div class="box-body">
                            abc
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box box-solid box-height-260 box-type-1">
                        <div class="box-header">
                            <h5 class="box-title">NHÓM HÀNG</h5>
                        </div>
                        <div class="box-body">
                            abc
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-solid box-height-260" style="position: relative;">
                        <div class="report-title">F1</div>
                        <div class="box-body">
                            <canvas id="report-f1" width="400" height="260" style="width: 100%; height: 260px;"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box box-solid box-height-260" style="position: relative;">
                        <div class="report-title">FA</div>
                        <div class="box-body">
                            <canvas id="report-fa" width="400" height="260" style="width: 100%; height: 260px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box box-solid" style="width: 100%; height: 540px;"></div>
        </div>
        <div class="col-md-3">
            <div class="box box-solid box-height-280">
                <div class="box-body">
                    <img src="img/img.jpg" alt="logo" style="width: 100%; height: 260px;">
                </div>
            </div>
        </div>
        <div class="col-md-5"">
            <div class="box box-solid box-height-280" style="position: relative;">
                <div class="report-title">Report 3</div>
                <div class="box-body">
                    <canvas id="report-3" width="400" height="260" style="width: 100%; height: 260px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4"">
            <div class="box box-solid box-height-280" style="position: relative;">
                <div class="report-title">Report 4</div>
                <div class="box-body">
                    <canvas id="report-4" width="400" height="260" style="width: 100%; height: 260px;"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="js/dashboard.js"></script>
    <script type="text/javascript" src="js/transition.js"></script>
    <script type="text/javascript" src="js/collapse.js"></script>
    <script type="text/javascript" src="js/bootstrap-datetimepicker.js"></script>
    <script>
        $(function () {
            $('#datetimepicker6').datetimepicker();
            $('#datetimepicker7').datetimepicker({
                useCurrent: false //Important! See issue #1075
            });
            $("#datetimepicker6").on("dp.change", function (e) {
                $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
            });
            $("#datetimepicker7").on("dp.change", function (e) {
                $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
            });
        });
    </script>
    <script>
        var dashboard = new window.Controller.Dashboard();
    </script>
    
@endpush