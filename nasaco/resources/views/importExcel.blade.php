@extends('layouts.home',['activemenuitem'=>'importExcel'])

@push('styles')
    <link rel="stylesheet" href="/tooltipster/dist/css/tooltipster.bundle.min.css" type="text/css" />
    <link rel="stylesheet" href="/tooltipster/dist/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-punk.min.css" type="text/css" />
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <link rel="stylesheet" href="css/default.css" type="text/css"></link>
     <link rel="stylesheet" href=" https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" type="text/css" />
   
@endpush

@section('content-header')
    <h1>
        Import Data
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Import Data</li>
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
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">           
                        <button data-toggle="modal" data-target="#myModal">Import Excel</button>
                    </div>
                    <div class="col-md-6">
                        @include('dashboard.time-picker')
                    </div>
                </div>
            </div>
        </div>     
    </div>
    
    <div class="row">
        <div class="box box-solid box-height-220">
            <div class="overlay display-none" id="loading-2">
                @include('dashboard.loading')
            </div>
            <div class="box-body">
                <table id="table-bills" class="table">
                
                </table>
            </div>
        </div>
    </div>

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog" style="border: none">
            <!-- Modal content-->
            <div class="box box-primary">
            <div class="box-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Import CSV</h4>
            </div>
            <div class="box-body">
                <input id="iportCSV" type="file" name="xlfile" id="xlf">
            </div>
            <div class="box-footer">
                <button id="submit" type="button" class="btn btn-default" >Import</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            <div style="display:none" id="loading" class="overlay">
                <div class='uil-default-css' style='transform:scale(0.53);margin:auto;height: 50px;'>
                <div style='top:80px;left:93px;width:14px;height:40px;background:#00b2ff;-webkit-transform:rotate(0deg) translate(0,-60px);transform:rotate(0deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#00b2ff;-webkit-transform:rotate(30deg) translate(0,-60px);transform:rotate(30deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#00b2ff;-webkit-transform:rotate(60deg) translate(0,-60px);transform:rotate(60deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#00b2ff;-webkit-transform:rotate(90deg) translate(0,-60px);transform:rotate(90deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#00b2ff;-webkit-transform:rotate(120deg) translate(0,-60px);transform:rotate(120deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#00b2ff;-webkit-transform:rotate(150deg) translate(0,-60px);transform:rotate(150deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#00b2ff;-webkit-transform:rotate(180deg) translate(0,-60px);transform:rotate(180deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#00b2ff;-webkit-transform:rotate(210deg) translate(0,-60px);transform:rotate(210deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#00b2ff;-webkit-transform:rotate(240deg) translate(0,-60px);transform:rotate(240deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#00b2ff;-webkit-transform:rotate(270deg) translate(0,-60px);transform:rotate(270deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#00b2ff;-webkit-transform:rotate(300deg) translate(0,-60px);transform:rotate(300deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#00b2ff;-webkit-transform:rotate(330deg) translate(0,-60px);transform:rotate(330deg) translate(0,-60px);border-radius:10px;position:absolute;'>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div id="bill_detail" class="modal fade" role="dialog">
        <div class="modal-dialog" style="border: none">
            <!-- Modal content-->
            <div class="box box-primary">
            <div class="box-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Hóa đơn</h4>
            </div>
            <div class="box-body">
                <div class="box-body">

                    <!--{ title: "Ngày" },
                    { title: "Mặt hàng" },
                    { title: "Nhóm hàng" },
                    { title: "Diễn giải" },	
                    //{ title: "Tỉnh thành" },
                    { title: "ĐVT" },
                    { title: "SL Đặt hàng" },	 
                    { title: "SL Thực xuất" },	 
                    { title: "SL Thanh Toán" },
                    { title: "Còn lại " },
                    { title: "Đơn Giá " },	
                    { title: "Thanh toán" },-->
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Ngày</label>

                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="bill_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Mặt hàng</label>

                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="bill_mat_hang" placeholder="Mặt hàng">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Nhóm hàng</label>

                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="bill_nhom_hang" placeholder="Nhóm hàng">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Diễn giải</label>

                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="bill_dien_giai" placeholder="Diễn giải">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Password</label>

                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                        </div>
                    </div>
                
                </div>
            </div>
            <div class="box-footer">
                <button id="submit" type="button" class="btn btn-default" >Cập nhật</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
            <div style="display:none" id="loading" class="overlay">
                <div class='uil-default-css' style='transform:scale(0.53);margin:auto;height: 50px;'>
                <div style='top:80px;left:93px;width:14px;height:40px;background:#00b2ff;-webkit-transform:rotate(0deg) translate(0,-60px);transform:rotate(0deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#00b2ff;-webkit-transform:rotate(30deg) translate(0,-60px);transform:rotate(30deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#00b2ff;-webkit-transform:rotate(60deg) translate(0,-60px);transform:rotate(60deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#00b2ff;-webkit-transform:rotate(90deg) translate(0,-60px);transform:rotate(90deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#00b2ff;-webkit-transform:rotate(120deg) translate(0,-60px);transform:rotate(120deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#00b2ff;-webkit-transform:rotate(150deg) translate(0,-60px);transform:rotate(150deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#00b2ff;-webkit-transform:rotate(180deg) translate(0,-60px);transform:rotate(180deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#00b2ff;-webkit-transform:rotate(210deg) translate(0,-60px);transform:rotate(210deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#00b2ff;-webkit-transform:rotate(240deg) translate(0,-60px);transform:rotate(240deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#00b2ff;-webkit-transform:rotate(270deg) translate(0,-60px);transform:rotate(270deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#00b2ff;-webkit-transform:rotate(300deg) translate(0,-60px);transform:rotate(300deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#00b2ff;-webkit-transform:rotate(330deg) translate(0,-60px);transform:rotate(330deg) translate(0,-60px);border-radius:10px;position:absolute;'>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection

@push('script-libs')
    <script src="js/jquery.dataTables.min.js"></script>
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
    
@endpush

@push('scripts')
    <script src="js/importcsv.js"></script>

    <script>
        
        window.Controller = window.Controller || {};
        var controller = window.Controller;
        controller.DateFilter = { startTime: moment().subtract(3, 'years').format('YYYY-MM-DD'), endTime: moment().format('YYYY-MM-DD') };
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
                "startDate": moment().subtract(3, 'years'),
                "endDate": moment(),
                "opens": "left"
            }, function(start, end, label) {
                controller.DateFilter.startTime = start.format('YYYY-MM-DD');
                controller.DateFilter.endTime = end.format('YYYY-MM-DD');
            })
        });
        
       
    </script>
    <script>

        var importCsv;

        function deleteBills(id) {
            var r = confirm("Xoá hóa đơn hàng vừa chọn");

            if (r == true) {
                axios.delete('/api/bills/'+id
                ).then(function (e) {
                    alert("Xoá hóa đơn hàng thành công.")
                }).catch(function (e) {
                    alert("Có lỗi xảy ra.Vui lòng liên hệ admin.")
                })
            } 
        }

        var table;
        function fillData(bills) {
            dataSet = [];
            bills.forEach(bill=>{
                dataSet.push([
                    bill.id,
                    bill.ngayThangNam,
                    bill.matHang,
                    bill.nhomHang,
                    bill.dienGiai,
                    //bill.tinhThanh,
                    bill.donViTinh,
                    bill.soLuongDatHang != null ? bill.soLuongDatHang : 0,
                    bill.soLuongThucXuat != null ? bill.soLuongThucXuat : 0,
                    bill.soLuongThanhToan != null ? bill.soLuongThanhToan : 0,
                    bill.conLai != null ? bill.conLai : 0,
                    bill.donGia,
                    bill.thanhTienThanhToan == null ? bill.thanhTienThanhToan : 0
                ])
            })
            
           table =  $('#table-bills').DataTable({
                destroy:true,
                data: dataSet,
                columns: [
                    { title: "ID" , visible : false },
                    { title: "Ngày" },
                    { title: "Mặt hàng" },
                    { title: "Nhóm hàng" },
                    { title: "Diễn giải" },	
                    //{ title: "Tỉnh thành" },
                    { title: "ĐVT" },
                    { title: "SL Đặt hàng" },	 
                    { title: "SL Thực xuất" },	 
                    { title: "SL Thanh Toán" },
                    { title: "Còn lại " },
                    { title: "Đơn Giá " },	
                    { title: "Thanh toán" },
                    { title: "Sửa" },
                    { title: "Xóa" }
                ],
                columnDefs: [ {
                    "targets": -1,
                    "data": null,
                    "defaultContent": "<button class='delete'>Xóa</button>"
                } ]                      
            });

            $('#table-bills tbody').off('click');

            $('#table-bills .delete').on( 'click', function () {
                var data = table.row($(this).parents('tr')).data()
                deleteBills(data[0]);
                importCsv.getBills();
            }); 

            $('#table-bills .edit').on( 'click', function () {
                var data = table.row($(this).parents('tr')).data()
                $('#bill_detail').modal() 
            }); 

             
        }
        
        $(function () {
            importCsv = new window.Controller.importCsv();
            $('#change_daterange').click(function () {
               
                importCsv.getBills();
            });      
        });
    </script>
@endpush