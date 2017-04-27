window.Controller = window.Controller || {};

(function(Controller) {
    Controller.Dashboard = function() {
        this.initType();
        this.getData();
    }


    Controller.Dashboard.prototype.drawGauge = function(data) {

        var soLieu = {};
        var total_tong_xuat = 0;
        if (data.result.length == 0) return;
        data.result.forEach(function(e) {
            soLieu[e.nhomHang] = e;
            total_tong_xuat += e.soLuongThucXuat;
        });
        for(let item of this.types) {
            if(!soLieu[item]) {
                soLieu[item] = {};
                soLieu[item].soLuongThucXuat = 0;
                soLieu[item].soLuongThanhToan = 0;
                soLieu[item].soLuongHangNhap = 0;
            }
        }

        var value = soLieu.F1.soLuongThucXuat + soLieu.FA.soLuongThucXuat;

        var percent = total_tong_xuat > 0 ? value / total_tong_xuat * 100 : 0;

        var chart = new Da.GoogleGaugeChart({
            containerElement: $('#gauge-report')[0],
            disableTooltip: true,
        });
        chart.options.width = 120;
        chart.options.height = 120;
        chart.options.redColor = "#f55072";
        chart.options.redFrom = 0;
        chart.options.redTo = 50;
        chart.options.yellowColor = "#f0cb18";
        chart.options.yellowFrom = 50;
        chart.options.yellowTo = 75;
        chart.options.greenColor = "#12c5a7";
        chart.options.greenFrom = 75;
        chart.options.greenTo = 100;
        chart.draw(
            [
                ['Label', 'Value'],
                ['Percent', Math.round(percent)],
            ]
        );
        $('#tong_xuat_f1_fa').html(value);
        var content = "<tr>\
                                <td\>TỔNG XUẤT</td\>\
                                <td>" + soLieu.F1.soLuongThucXuat + "</td>\
                                <td>" + soLieu.F2.soLuongThucXuat + "</td>\
                                <td>" + soLieu.FA.soLuongThucXuat + "</td>\
                            </tr>\
                            <tr>\
                                <td>THANH TOÁN</td>\
                                <td>" + soLieu.F1.soLuongThanhToan + "</td>\
                                <td>" + soLieu.F2.soLuongThanhToan + "</td>\
                                <td>" + soLieu.FA.soLuongThanhToan + "</td>\
                            </tr>\
                            <tr>\
                                <td>CÒN LẠI</td>\
                                <td>" + (soLieu.F1.soLuongThucXuat - soLieu.F1.soLuongThanhToan) + "</td>\
                                <td>" + (soLieu.F2.soLuongThucXuat - soLieu.F2.soLuongThanhToan) + "</td>\
                                <td>" + (soLieu.FA.soLuongThucXuat - soLieu.FA.soLuongThanhToan) + "</td>\
                                </tr>\
                            <tr>\
                                <td>HÀNG NHẬP</td>\
                                <td>" + (soLieu.F1.soLuongHangNhap) + "</td>\
                                <td>" + (soLieu.F2.soLuongHangNhap) + "</td>\
                                <td>" + (soLieu.FA.soLuongHangNhap) + "</td>\
                            </tr>"
        $('#table_1').html(content);

        content = "<tr>\
                    <td></td>\
                    <td>" + soLieu.E.soLuongThucXuat + "</td>\
                    <td>" + soLieu.G.soLuongThucXuat + "</td>\
                </tr>\
                <tr>\
                    <td></td>\
                    <td>" + soLieu.E.soLuongThanhToan + "</td>\
                    <td>" + soLieu.G.soLuongThanhToan + "</td>\
                </tr>\
                <tr>\
                    <td></td>\
                    <td>" + (soLieu.E.soLuongThucXuat - soLieu.E.soLuongThanhToan) + "</td>\
                    <td>" + (soLieu.G.soLuongThucXuat - soLieu.G.soLuongThanhToan) + "</td>\
                </tr>\
                <tr>\
                    <td></td>\
                    <td>" + soLieu.E.soLuongHangNhap + "</td>\
                    <td>" + soLieu.G.soLuongHangNhap + "</td>\
                </tr>";


        $('#table_2').html(content);
    };

    Controller.Dashboard.prototype.filltable = function(data) {

        var soLieu = {};

        console.log(data);

        if (data.result.length == 0) return;
        data.result.forEach(function(e) {
            soLieu[e.nhomHang] = e;
        });

        for(let item of this.types) {
            if(!soLieu[item]) {
                soLieu[item] = {};
                soLieu[item].soLuongThucXuat = 0;
                soLieu[item].soLuongDatHang = 0;
                soLieu[item].soLuongTon = 0;
            }
        }

        var content = "<tr>\
                        <td>TỔNG NHẬP</td>\
                        <td>" + (soLieu.F1.soLuongDatHang + soLieu.F2.soLuongDatHang + soLieu.FA.soLuongDatHang) + "</td>\
                        <td>" + soLieu.E.soLuongDatHang + "</td>\
                        <td>" + soLieu.G.soLuongDatHang + "</td>\
                    </tr>\
                    <tr>\
                        <td>TỔNG XUẤT</td>\
                        <td>" + (soLieu.F1.soLuongThucXuat + soLieu.F2.soLuongThucXuat + soLieu.FA.soLuongThucXuat) + "</td>\
                        <td>" + soLieu.E.soLuongThucXuat + "</td>\
                        <td>" + soLieu.G.soLuongThucXuat + "</td>\
                    </tr>\
                    <tr>\
                        <td>TỒN</td>\
                        <td>" + (soLieu.F1.soLuongTon + soLieu.F2.soLuongTon + soLieu.FA.soLuongTon) + "</td>\
                        <td>" + soLieu.E.soLuongTon + "</td>\
                        <td>" + soLieu.G.soLuongTon + "</td>\
                    </tr>";

        $('#table_3').html(content);

    };

    Controller.Dashboard.prototype.getData = function() {
        this.initProvince();
    }

    Controller.Dashboard.prototype.fillData = function() {
        this.callApiTongSuatThanhToan();
        this.callApiXuatNhapTon();
        this.callApiListProvince();
        this.callApithongKeTheoNhomHang();
    }

    Controller.Dashboard.prototype.initType = function() {
        let me = this;
        let tb = $('#list-type');
        let trs = $(tb.children()[0]).children();
        this.types = [];
        for(let tr of trs) {
            this.types.push($(tr).data('value'));
            $(tr).click(() => {
                me.toggleSelect(tr);
            });
        }
    }

    Controller.Dashboard.prototype.initProvince = function() {
        var me = this;
        var timeRange = this.getDateTimeFilter();
        axios.get('/api/baoCao/danhSachTinhThanhCoDatHang', {
            params: {
                startTime: timeRange.startTime,
                endTime: timeRange.endTime
            }
        })
        .then(function(response) {
            me.fillListProvice(response.data);
            me.fillData();
        }).catch(function(e) {
            console.log(e);
            alert("Có lỗi xảy ra.Vui lòng liên hệ admin.")
        })
    }

    Controller.Dashboard.prototype.getDateTimeFilter = function() {
        var result = { startTime: moment().subtract(3, 'years'), endTime: moment() };
        if (Controller.DateFilter) result = Controller.DateFilter;
        return result;
    }

    Controller.Dashboard.prototype.callApiXuatNhapTon = function() {
        var me = this;
        var timeRange = this.getDateTimeFilter();
        $("#loading-4").css("display", "block");
        axios.get('/api/baoCao/xuatNhapTon', {
                params: {
                    startTime: timeRange.startTime,
                    endTime: timeRange.endTime,
                    postal_codes: me.getSelectedValue('list-provice').toString(),
                    types: me.getSelectedValue('list-type').toString()
                }
            })
            .then(function(response) {
                $("#loading-4").css("display", "none");
                me.filltable(response.data);
            }).catch(function(e) {
                console.log(e);
                alert("Có lỗi xảy ra.Vui lòng liên hệ admin.")
            })
    }

    Controller.Dashboard.prototype.callApiGet = function(url, callback) {
        var me = this;
        var timeRange = this.getDateTimeFilter();
        axios.get('/api/baoCao/xuatNhapTon', {
                params: {
                    startTime: timeRange.startTime,
                    endTime: timeRange.endTime
                }
            })
            .then(function(response) {
                callback(response.data);
            }).catch(function(e) {
                console.log(e);
                alert("Có lỗi xảy ra.Vui lòng liên hệ admin.")
            })
    }

    Controller.Dashboard.prototype.callApiTongSuatThanhToan = function() {
        var me = this;
        var timeRange = this.getDateTimeFilter();

        $("#loading-1").css("display", "block");
        $("#loading-3").css("display", "block");
        axios.get('/api/baoCao/tongSuatThanhToanTheoNhomHang', {
                params: {
                    startTime: timeRange.startTime,
                    endTime: timeRange.endTime,
                    postal_codes: me.getSelectedValue('list-provice').toString(),
                    types: me.getSelectedValue('list-type').toString()
                }
            })
            .then(function(response) {
                me.drawGauge(response.data);
                $("#loading-1").css("display", "none");
                $("#loading-3").css("display", "none");

            }).catch(function(e) {
                console.log(e);
                alert("Có lỗi xảy ra.Vui lòng liên hệ admin.")
            })
    }

    Controller.Dashboard.prototype.callApiListProvince = function() {
        var me = this;
        var timeRange = this.getDateTimeFilter();
        $("#loading-2").css("display", "block");
        $("#loading-5").css("display", "block");
        $("#loading-6").css("display", "block");
        $("#loading-7").css("display", "block");
        $("#loading-8").css("display", "block");
        $("#loading-9").css("display", "block");
        axios.get('/api/baoCao/thongKeTheoTinh', {
                params: {
                    startTime: timeRange.startTime,
                    endTime: timeRange.endTime,
                    postal_codes: me.getSelectedValue('list-provice').toString(),
                    types: me.getSelectedValue('list-type').toString()
                }
            })
            .then(function(response) {
                // me.fillListProvice(response.data);
                $("#loading-6").css("display", "none");
                $("#loading-2").css("display", "none");
                $("#loading-5").css("display", "none");
                $("#loading-7").css("display", "none");
                $("#loading-8").css("display", "none");
                $("#loading-9").css("display", "none");
                me.drawReportF1(response.data);
                me.drawReportFa(response.data);
                me.drawReport3(response.data);
                me.drawGeoChart(response.data);
            }).catch(function(e) {
                console.log(e);
                alert("Có lỗi xảy ra.Vui lòng liên hệ admin.")
            })
    }

    Controller.Dashboard.prototype.fillListProvice = function(data) {
        let me = this;
        let table = $('#list-provice');
        table.html("");
        let tbody = $('<tbody></tbody>');
        table.append(tbody);
        if (data.result.length == 0) return;
        data.result.forEach(function(e) {
            let tr = $('<tr data-value="' + e.ma_buu_chinh +  '"><td>' + e.name + "</td></tr>");
            tr.click(() => {
                me.toggleSelect(tr);
            });
            tbody.append(tr);
        });
    }

    Controller.Dashboard.prototype.clearSelected = function(id) {
        let tb = $('#'+id);
        let trs = $(tb.children()[0]).children();
        for(let tr of trs) {
            $(tr).removeClass('selected');
        }
    }

    Controller.Dashboard.prototype.getSelectedValue = function(id) {
        let data = [];
        let tb = $('#'+id);
        let trs = $(tb.children()[0]).children();
        for(let tr of trs) {
            if($(tr).hasClass('selected')) {
                data.push($(tr).data('value'));
            }
        }
        return data;
    }

    Controller.Dashboard.prototype.toggleSelect = function(div) {
        if($(div).hasClass('selected')) {
            $(div).removeClass('selected');
        } else {
            $(div).addClass('selected');
        }
    }

    Controller.Dashboard.prototype.callApithongKeTheoNhomHang = function() {
        var me = this;
        var timeRange = this.getDateTimeFilter();
        $("#loading-10").css("display", "block");
        axios.get('/api/baoCao/thongKeTheoNhomHang', {
                params: {
                    startTime: timeRange.startTime,
                    endTime: timeRange.endTime,
                    postal_codes: me.getSelectedValue('list-provice').toString(),
                    types: me.getSelectedValue('list-type').toString()
                }
            })
            .then(function(response) {
                $("#loading-10").css("display", "none");
                me.drawReport4(response.data);
            }).catch(function(e) {
                console.log(e);
                alert("Có lỗi xảy ra.Vui lòng liên hệ admin.")
            })
    }

    Controller.Dashboard.prototype.drawGeoChart = function(source) {

        var areas = [];

        source.result.forEach(function(e) {

            var total = 0;
            total += e.dataTheoNhom[0].soLuongDatHang;
            total += e.dataTheoNhom[1].soLuongDatHang;
            total += e.dataTheoNhom[2].soLuongDatHang;
            total += e.dataTheoNhom[3].soLuongDatHang;
            total += e.dataTheoNhom[4].soLuongDatHang;
            areas.push({ id: e.code, value: total });
        });

        var map = AmCharts.makeChart("geochart-colors", {
            "type": "map",
            "theme": "light",
            "colorSteps": 10,

            "dataProvider": {
                "map": "vietnamLow",
                "areas": areas
            },

            "areasSettings": {
                "autoZoom": true,
                "colorSolid": '#219c97',
                "color": "#aee7de"
            },

            "valueLegend": {
                "right": 10,
                "minValue": "Low",
                "maxValue": "High"
            },

            "export": {
                "enabled": true
            }

        });
    };

    Controller.Dashboard.prototype.drawReportF1 = function(source) {
        var labels = [];
        var dataDatHang = [];
        var dataThucXuat = [];
        var dataThanhToan = [];

        source.result.forEach(function(e) {
            labels.push(e.name);
            dataDatHang.push(e.dataTheoNhom[0].soLuongDatHang);
            dataThucXuat.push(e.dataTheoNhom[0].soLuongThucXuat);
            dataThanhToan.push(e.dataTheoNhom[0].soLuongThanhToan);
        });
        $('#report-f1-container').html('<canvas id="report-f1" width="400" height="260" style="width: 100%; height: 260px;"></canvas>');
        var item = document.getElementById('report-f1');
        var data = {
            labels: labels,
            datasets: [{
                    label: "ĐẶT HÀNG",
                    backgroundColor: 'rgba(174, 231, 222, 1)',
                    data: dataDatHang,
                },
                {
                    label: "THỰC XUẤT",
                    backgroundColor: 'rgba(37, 194, 185, 1)',
                    data: dataThucXuat,
                },
                {
                    label: "THANH TOÁN",
                    backgroundColor: 'rgba(33, 159, 147, 1)',
                    data: dataThanhToan,
                }
            ]
        };
        this.myBarChart = new Chart(item, {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }

    Controller.Dashboard.prototype.drawReportFa = function(source) {
        var labels = [];
        var dataDatHang = [];
        var dataThucXuat = [];
        var dataThanhToan = [];
        source.result.forEach(function(e) {
            labels.push(e.name);
            dataDatHang.push(e.dataTheoNhom[2].soLuongDatHang);
            dataThucXuat.push(e.dataTheoNhom[2].soLuongThucXuat);
            dataThanhToan.push(e.dataTheoNhom[2].soLuongThanhToan);
        });
        $('#report-fa-container').html('<canvas id="report-fa" width="400" height="260" style="width: 100%; height: 260px;"></canvas>');
        var item = document.getElementById('report-fa');
        var data = {
            labels: labels,
            datasets: [{
                    label: "ĐẶT HÀNG",
                    backgroundColor: 'rgba(174, 231, 222, 1)',
                    data: dataDatHang,
                },
                {
                    label: "THỰC XUẤT",
                    backgroundColor: 'rgba(37, 194, 185, 1)',
                    data: dataThucXuat,
                },
                {
                    label: "THANH TOÁN",
                    backgroundColor: 'rgba(33, 159, 147, 1)',
                    data: dataThanhToan,
                }
            ]
        };
        var myBarChart = new Chart(item, {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }

    Controller.Dashboard.prototype.drawReport3 = function(source) {
        var labels = [];
        var dataTheoNhomNganh = { F1: [], F2: [], FA: [], E: [], G: [] };

        source.result.forEach(function(e) {
            labels.push(e.name);
            dataTheoNhomNganh.F1.push(e.dataTheoNhom[0].soLuongDatHang);
            dataTheoNhomNganh.F2.push(e.dataTheoNhom[1].soLuongDatHang);
            dataTheoNhomNganh.FA.push(e.dataTheoNhom[2].soLuongDatHang);
            dataTheoNhomNganh.E.push(e.dataTheoNhom[3].soLuongDatHang);
            dataTheoNhomNganh.G.push(e.dataTheoNhom[4].soLuongDatHang);

        });
        let height = source.result.length * 20 + 20;
        $('#report-3-container').html('<canvas id="report-3" width="400" height="'+ height +'" style="width: 100% ;height:'+ height +'px"></canvas>');
        var item = document.getElementById('report-3');
        var data = {
            labels: labels,
            datasets: [{
                    label: "F1",
                    backgroundColor: 'rgb(18,197,167)',
                    data: dataTheoNhomNganh.F1,
                },
                {
                    label: "F2",
                    backgroundColor: 'rgb(132,135,140)',
                    data: dataTheoNhomNganh.F2,
                },
                {
                    label: "FA",
                    backgroundColor: 'rgb(245,80,114)',
                    data: dataTheoNhomNganh.FA,
                },
                {
                    label: "E",
                    backgroundColor: 'rgb(240,203,24)',
                    data: dataTheoNhomNganh.E,
                },
                {
                    label: "G",
                    backgroundColor: 'rgb(61,69,71)',
                    data: dataTheoNhomNganh.G,
                }
            ],
        };
        var myBarChart = new Chart(item, {
            type: 'horizontalBar',
            data: data,
            options: {
                scales: {
                    xAxes: [{
                        stacked: true,
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                        }
                    }]
                },
                responsive: true,
                maintainAspectRatio: true
            }
        });
    }

    Controller.Dashboard.prototype.drawReport4 = function(datas) {
        var soLieu = [];
        datas.result.forEach(function(e) {
            soLieu.push(e.soLuongDatHang);
        });
        $('#report-4-container').html('<canvas id="report-4" width="270" height="180" style="width: 270px; height: 180px;"></canvas>');
        var item = document.getElementById('report-4');
        var data = {
            labels: ["F1", "F2", "FA", "E", "G"],
            datasets: [{
                data: soLieu,
                backgroundColor: [
                    "rgb(18,197,167)",
                    "rgb(132,135,140)",
                    "rgb(245,80,114)",
                    "rgb(240,203,24)",
                    "rgb(61,69,71)",
                ]
            }]
        };
        var doughnut = new Chart(item, {
            type: 'doughnut',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'right'
                }
            }
        });
    }
})(window.Controller);
