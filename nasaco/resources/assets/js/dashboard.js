window.Controller = window.Controller || {};

(function(Controller) {
    Controller.Dashboard = function() {
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

        var value = soLieu.F1.soLuongThucXuat + soLieu.FA.soLuongThucXuat;

        var percent = total_tong_xuat > 0 ? value / total_tong_xuat * 100 : 0;

        var chart = new Da.GoogleGaugeChart({
            containerElement: $('#gauge-report')[0],
            disableTooltip: true,
        });
        chart.options.width = 120;
        chart.options.height = 120;
        chart.redFrom = 75;
        chart.redTo = 100;
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
                </tr>"


        $('#table_2').html(content);
    };

    Controller.Dashboard.prototype.filltable = function(data) {

        var soLieu = {};

        if (data.result.length == 0) return;
        data.result.forEach(function(e) {
            soLieu[e.nhomHang] = e;
        });

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
        this.callApiTongSuatThanhToan();
        this.callApiXuatNhapTon();
        this.callApiListProvince();
        this.callApithongKeTheoNhomHang();
    }

    Controller.Dashboard.prototype.getDateTimeFilter = function() {
        var result = { startTime: moment(), endTime: moment() };
        if (Controller.DateFilter) result = Controller.DateFilter;
        return result;
    }

    Controller.Dashboard.prototype.callApiXuatNhapTon = function() {
        var me = this;
        var timeRange = this.getDateTimeFilter();
        axios.get('/api/baoCao/xuatNhapTon', {
                params: {
                    startTime: timeRange.startTime,
                    endTime: timeRange.endTime
                }
            })
            .then(function(response) {
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
        axios.get('/api/baoCao/tongSuatThanhToanTheoNhomHang', {
                params: {
                    startTime: timeRange.startTime,
                    endTime: timeRange.endTime
                }
            })
            .then(function(response) {
                me.drawGauge(response.data);
            }).catch(function(e) {
                console.log(e);
                alert("Có lỗi xảy ra.Vui lòng liên hệ admin.")
            })
    }

    Controller.Dashboard.prototype.callApiListProvince = function() {
        var me = this;
        var timeRange = this.getDateTimeFilter();
        axios.get('/api/baoCao/thongKeTheoTinh', {
                params: {
                    startTime: timeRange.startTime,
                    endTime: timeRange.endTime
                }
            })
            .then(function(response) {
                me.fillListProvice(response.data);
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
        var content = "";
        if (data.result.length == 0) return;
        data.result.forEach(function(e) {
            content += "<tr><td>" + e.name + "</td></tr>";
        });
        $('#list-provice').html(content);

    }

    Controller.Dashboard.prototype.callApithongKeTheoNhomHang = function() {
        var me = this;
        var timeRange = this.getDateTimeFilter();
        axios.get('/api/baoCao/thongKeTheoNhomHang', {
                params: {
                    startTime: timeRange.startTime,
                    endTime: timeRange.endTime
                }
            })
            .then(function(response) {
                me.drawReport4(response.data);
            }).catch(function(e) {
                console.log(e);
                alert("Có lỗi xảy ra.Vui lòng liên hệ admin.")
            })
    }

    Controller.Dashboard.prototype.drawGeoChart = function(source) {

        var areas = [];

        if (source.result.length == 0) return;
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
                "autoZoom": true
            },

            "valueLegend": {
                "right": 10,
                "minValue": "little",
                "maxValue": "a lot!"
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

        if (source.result.length == 0) return;
        source.result.forEach(function(e) {
            labels.push(e.name);
            dataDatHang.push(e.dataTheoNhom[0].soLuongDatHang);
            dataThucXuat.push(e.dataTheoNhom[0].soLuongThucXuat);
            dataThanhToan.push(e.dataTheoNhom[0].soLuongThanhToan);
        });

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

    Controller.Dashboard.prototype.drawReportFa = function(source) {
        var labels = [];
        var dataDatHang = [];
        var dataThucXuat = [];
        var dataThanhToan = [];

        if (source.result.length == 0) return;
        source.result.forEach(function(e) {
            labels.push(e.name);
            dataDatHang.push(e.dataTheoNhom[2].soLuongDatHang);
            dataThucXuat.push(e.dataTheoNhom[2].soLuongThucXuat);
            dataThanhToan.push(e.dataTheoNhom[2].soLuongThanhToan);
        });

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

        if (source.result.length == 0) return;
        source.result.forEach(function(e) {
            labels.push(e.name);
            dataTheoNhomNganh.F1.push(e.dataTheoNhom[0].soLuongDatHang);
            dataTheoNhomNganh.F2.push(e.dataTheoNhom[1].soLuongDatHang);
            dataTheoNhomNganh.FA.push(e.dataTheoNhom[2].soLuongDatHang);
            dataTheoNhomNganh.E.push(e.dataTheoNhom[3].soLuongDatHang);
            dataTheoNhomNganh.G.push(e.dataTheoNhom[4].soLuongDatHang);

        });

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
                maintainAspectRatio: false
            }
        });
    }

    Controller.Dashboard.prototype.drawReport4 = function(datas) {

        var soLieu = [];
        if (datas.result.length == 0) return;
        datas.result.forEach(function(e) {
            soLieu.push(e.soLuongDatHang);
        });

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