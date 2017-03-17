window.Controller = window.Controller || {};

(function(Controller){
    Controller.Dashboard = function() {
        this.drawReportF1();
        this.drawReportFa();
        this.drawReport3();
        this.drawReport4();
    }

    Controller.Dashboard.prototype.drawReportF1 = function() {
        var item = document.getElementById('report-f1');
        var data = {
            labels: ["Hà Nội", "Bắc Giang", "Tuyên Quang", "Hà Nam", "Bắc Ninh", "Thanh Hóa", "Hà Tĩnh","Hà Nội", "Bắc Giang", "Tuyên Quang", "Hà Nam", "Bắc Ninh", "Thanh Hóa", "Hà Tĩnh"],
            datasets: [
                {
                    label: "ĐẶT HÀNG",
                    backgroundColor:'rgba(174, 231, 222, 1)',
                    data: [65, 59, 80, 81, 56, 55, 40,65, 59, 80, 81, 56, 55, 40],
                },
                {
                    label: "THỰC XUẤT",
                    backgroundColor:'rgba(37, 194, 185, 1)',
                    data: [59, 80, 81, 56, 55, 40, 12,65, 59, 80, 81, 56, 55, 40],
                },
                {
                    label: "THANH TOÁN",
                    backgroundColor:'rgba(33, 159, 147, 1)',
                    data: [65, 56, 55, 40, 24, 54, 36,65, 59, 80, 81, 56, 55, 40],
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
            labels: ["Hà Nội", "Bắc Giang", "Tuyên Quang", "Hà Nam", "Bắc Ninh", "Thanh Hóa", "Hà Tĩnh","Hà Nội", "Bắc Giang", "Tuyên Quang", "Hà Nam", "Bắc Ninh", "Thanh Hóa", "Hà Tĩnh"],
            datasets: [
                {
                    label: "ĐẶT HÀNG",
                    backgroundColor:'rgba(174, 231, 222, 1)',
                    data: [65, 59, 80, 81, 56, 55, 40,65, 59, 80, 81, 56, 55, 40],
                },
                {
                    label: "THỰC XUẤT",
                    backgroundColor:'rgba(37, 194, 185, 1)',
                    data: [59, 80, 81, 56, 55, 40, 12,65, 59, 80, 81, 56, 55, 40],
                },
                {
                    label: "THANH TOÁN",
                    backgroundColor:'rgba(33, 159, 147, 1)',
                    data: [65, 56, 55, 40, 24, 54, 36,65, 59, 80, 81, 56, 55, 40],
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
            datasets: [
                {
                    label: "ĐẶT HÀNG",
                    backgroundColor:'rgba(174, 231, 222, 1)',
                    data: [65, 59, 80, 81, 56, 55, 40],
                },
                {
                    label: "THỰC XUẤT",
                    backgroundColor:'rgba(37, 194, 185, 1)',
                    data: [59, 80, 81, 56, 55, 40, 12],
                },
                {
                    label: "THANH TOÁN",
                    backgroundColor:'rgba(33, 159, 147, 1)',
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
            datasets: [
            {
                data: [300, 50, 100,120,240],
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


