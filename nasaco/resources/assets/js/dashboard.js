window.Controller = window.Controller || {};

(function(Controller) {
    Controller.Dashboard = function() {
        this.getData();
        // this.drawGauge();
        // this.drawGeoChart();
        // this.drawReportF1();
        // this.drawReportFa();
        // this.drawReport3();
        // this.drawReport4();
    }

    Controller.Dashboard.prototype.drawGauge = function(value, percent) {
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
                ['Percent', percent],
            ]
        );
        $('#tong_xuat_f1_fa').html(value);
    };

    Controller.Dashboard.prototype.getData = function() {
        callApiTongSuatThanhToan();
    }

    function getDateTimeFilter() {
        var result = {};

    }

    function callApiTongSuatThanhToan() {
        var timeRange = getDateTimeFilter();
        axios.get('/api/baoCao/tongSuatThanhToanTheoNhomHang', {
                params: {
                    startTime: timeRange.startTime,
                    endTime: timeRange.endTime
                }
            })
            .then(function(response) {
                alert("Nhập dữ liệu thành công.")
            }).catch(function(e) {
                console.log(e);
                alert("Có lỗi xảy ra.Vui lòng liên hệ admin.")
            })
    }


    Controller.Dashboard.prototype.drawGeoChart = function() {
        var map = AmCharts.makeChart("geochart-colors", {
            "type": "map",
            "theme": "light",
            "colorSteps": 10,

            "dataProvider": {
                "map": "vietnamLow",
                "areas": [{
                    "id": "VN-54",
                    "value": 4447100
                }, {
                    "id": "VN-56",
                    "value": 626932
                }]
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

    Controller.Dashboard.prototype.drawReportF1 = function() {
        var item = document.getElementById('report-f1');
        var data = {
            labels: ["Hà Nội", "Bắc Giang", "Tuyên Quang", "Hà Nam", "Bắc Ninh", "Thanh Hóa", "Hà Tĩnh", "Hà Nội", "Bắc Giang", "Tuyên Quang", "Hà Nam", "Bắc Ninh", "Thanh Hóa", "Hà Tĩnh"],
            datasets: [{
                    label: "ĐẶT HÀNG",
                    backgroundColor: 'rgba(174, 231, 222, 1)',
                    data: [65, 59, 80, 81, 56, 55, 40, 65, 59, 80, 81, 56, 55, 40],
                },
                {
                    label: "THỰC XUẤT",
                    backgroundColor: 'rgba(37, 194, 185, 1)',
                    data: [59, 80, 81, 56, 55, 40, 12, 65, 59, 80, 81, 56, 55, 40],
                },
                {
                    label: "THANH TOÁN",
                    backgroundColor: 'rgba(33, 159, 147, 1)',
                    data: [65, 56, 55, 40, 24, 54, 36, 65, 59, 80, 81, 56, 55, 40],
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

    Controller.Dashboard.prototype.drawReportFa = function() {
        var item = document.getElementById('report-fa');
        var data = {
            labels: ["Hà Nội", "Bắc Giang", "Tuyên Quang", "Hà Nam", "Bắc Ninh", "Thanh Hóa", "Hà Tĩnh", "Hà Nội", "Bắc Giang", "Tuyên Quang", "Hà Nam", "Bắc Ninh", "Thanh Hóa", "Hà Tĩnh"],
            datasets: [{
                    label: "ĐẶT HÀNG",
                    backgroundColor: 'rgba(174, 231, 222, 1)',
                    data: [65, 59, 80, 81, 56, 55, 40, 65, 59, 80, 81, 56, 55, 40],
                },
                {
                    label: "THỰC XUẤT",
                    backgroundColor: 'rgba(37, 194, 185, 1)',
                    data: [59, 80, 81, 56, 55, 40, 12, 65, 59, 80, 81, 56, 55, 40],
                },
                {
                    label: "THANH TOÁN",
                    backgroundColor: 'rgba(33, 159, 147, 1)',
                    data: [65, 56, 55, 40, 24, 54, 36, 65, 59, 80, 81, 56, 55, 40],
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

    Controller.Dashboard.prototype.drawReport3 = function() {
        var item = document.getElementById('report-3');
        var data = {
            labels: ["Hà Nội", "Bắc Giang", "Tuyên Quang", "Hà Nam", "Bắc Ninh", "Thanh Hóa", "Hà Tĩnh"],
            datasets: [{
                    label: "F1",
                    backgroundColor: 'rgb(18,197,167)',
                    data: [65, 59, 80, 81, 56, 55, 40],
                },
                {
                    label: "F2",
                    backgroundColor: 'rgb(132,135,140)',
                    data: [59, 80, 81, 56, 55, 40, 12],
                },
                {
                    label: "FA",
                    backgroundColor: 'rgb(245,80,114)',
                    data: [65, 56, 55, 40, 24, 54, 36],
                },
                {
                    label: "E",
                    backgroundColor: 'rgb(240,203,24)',
                    data: [65, 56, 55, 40, 24, 54, 36],
                },
                {
                    label: "G",
                    backgroundColor: 'rgb(61,69,71)',
                    data: [65, 56, 55, 40, 24, 54, 36],
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

    Controller.Dashboard.prototype.drawReport4 = function() {
        var item = document.getElementById('report-4');
        var data = {
            labels: ["F1", "F2", "FA", "E", "G"],
            datasets: [{
                data: [300, 50, 100, 120, 240],
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