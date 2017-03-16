/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "./";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 41);
/******/ })
/************************************************************************/
/******/ ({

/***/ 11:
/***/ (function(module, exports) {

window.Controller = window.Controller || {};

(function (Controller) {
    Controller.Dashboard = function () {
        this.drawReportF1();
        this.drawReportFa();
        this.drawReport3();
        this.drawReport4();
    };

    Controller.Dashboard.prototype.drawReportF1 = function () {
        var item = document.getElementById('report-f1');
        var data = {
            labels: ["Hà Nội", "Bắc Giang", "Tuyên Quang", "Hà Nam", "Bắc Ninh", "Thanh Hóa", "Hà Tĩnh", "Hà Nội", "Bắc Giang", "Tuyên Quang", "Hà Nam", "Bắc Ninh", "Thanh Hóa", "Hà Tĩnh"],
            datasets: [{
                label: "ĐẶT HÀNG",
                backgroundColor: 'rgba(174, 231, 222, 1)',
                data: [65, 59, 80, 81, 56, 55, 40, 65, 59, 80, 81, 56, 55, 40]
            }, {
                label: "THỰC XUẤT",
                backgroundColor: 'rgba(37, 194, 185, 1)',
                data: [59, 80, 81, 56, 55, 40, 12, 65, 59, 80, 81, 56, 55, 40]
            }, {
                label: "THANH TOÁN",
                backgroundColor: 'rgba(33, 159, 147, 1)',
                data: [65, 56, 55, 40, 24, 54, 36, 65, 59, 80, 81, 56, 55, 40]
            }]
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
    };

    Controller.Dashboard.prototype.drawReportFa = function () {
        var item = document.getElementById('report-fa');
        var data = {
            labels: ["Hà Nội", "Bắc Giang", "Tuyên Quang", "Hà Nam", "Bắc Ninh", "Thanh Hóa", "Hà Tĩnh", "Hà Nội", "Bắc Giang", "Tuyên Quang", "Hà Nam", "Bắc Ninh", "Thanh Hóa", "Hà Tĩnh"],
            datasets: [{
                label: "ĐẶT HÀNG",
                backgroundColor: 'rgba(174, 231, 222, 1)',
                data: [65, 59, 80, 81, 56, 55, 40, 65, 59, 80, 81, 56, 55, 40]
            }, {
                label: "THỰC XUẤT",
                backgroundColor: 'rgba(37, 194, 185, 1)',
                data: [59, 80, 81, 56, 55, 40, 12, 65, 59, 80, 81, 56, 55, 40]
            }, {
                label: "THANH TOÁN",
                backgroundColor: 'rgba(33, 159, 147, 1)',
                data: [65, 56, 55, 40, 24, 54, 36, 65, 59, 80, 81, 56, 55, 40]
            }]
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
    };

    Controller.Dashboard.prototype.drawReport3 = function () {
        var item = document.getElementById('report-3');
        var data = {
            labels: ["Hà Nội", "Bắc Giang", "Tuyên Quang", "Hà Nam", "Bắc Ninh", "Thanh Hóa", "Hà Tĩnh"],
            datasets: [{
                label: "ĐẶT HÀNG",
                backgroundColor: 'rgba(174, 231, 222, 1)',
                data: [65, 59, 80, 81, 56, 55, 40]
            }, {
                label: "THỰC XUẤT",
                backgroundColor: 'rgba(37, 194, 185, 1)',
                data: [59, 80, 81, 56, 55, 40, 12]
            }, {
                label: "THANH TOÁN",
                backgroundColor: 'rgba(33, 159, 147, 1)',
                data: [65, 56, 55, 40, 24, 54, 36]
            }]
        };
        var myBarChart = new Chart(item, {
            type: 'horizontalBar',
            data: data,
            options: {
                scales: {
                    xAxes: [{
                        stacked: true
                    }],
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
    };

    Controller.Dashboard.prototype.drawReport4 = function () {
        var item = document.getElementById('report-4');
        var data = {
            labels: ["F1", "F2", "FA", "E", "G"],
            datasets: [{
                data: [300, 50, 100, 120, 240],
                backgroundColor: ["rgb(18,197,167)", "rgb(132,135,140)", "rgb(245,80,114)", "rgb(240,203,24)", "rgb(61,69,71)"]
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
    };
})(window.Controller);

/***/ }),

/***/ 41:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(11);


/***/ })

/******/ });