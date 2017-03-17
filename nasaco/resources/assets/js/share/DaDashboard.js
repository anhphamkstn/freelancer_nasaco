window.Da = window.Da || {};

(function(Controller) {

    Controller.Widget = function(options) {
        this.eventListener = new Controller.Event();
        this.initContainer(options);
    }

    Controller.Widget.prototype.initContainer = function(options) {
        this.containerElement = $(options.containerElement);
        this.contentId = this.uniqId('chart');
        this.contentElement = $('<div style="width: 100%; height: 100%;"></div>');
        this.containerElement.html('');
        this.containerElement.css('position', 'relative');
        this.containerElement.append(this.contentElement);
        this.initTooltip(options);
        this.initEvent();
    }

    Controller.Widget.prototype.button = function(btnClass, iconClass) {
        var btn = jQuery('<button style="margin-left: 2px; margin-right: 2px;"></button>');
        btn.attr('type', 'button');
        btn.attr('class', 'btn ' + btnClass);
        btn.html('<i class="' + iconClass + '" aria-hidden="true"></i>');
        return btn;
    }

    Controller.Widget.prototype.buttonZoom = function() {
        var self = this;
        var zoom = this.button('btn-primary', 'glyphicon glyphicon-fullscreen');
        zoom.click(function() { self.eventListener.execute('zoom') });
        return zoom;
    }

    Controller.Widget.prototype.buttonAccept = function() {
        var self = this;
        var accept = this.button('btn-success', 'glyphicon glyphicon-ok');
        accept.click(function() { self.eventListener.execute('accept') });
        return accept;
    }

    Controller.Widget.prototype.buttonClear = function() {
        var self = this;
        var clear = this.button('btn-danger', 'glyphicon glyphicon-remove');
        clear.click(function() { self.eventListener.execute('clear') });
        return clear;
    }

    Controller.Widget.prototype.initTooltip = function(options) {
        if (options.disableTooltip) {
            return;
        }
        var tooltip = jQuery('<div></div>');
        tooltip.addClass('tooltip_templates');
        tooltip.css('display', 'none');
        var content = jQuery('<div></div>');
        tooltip.append(content);

        this.tooltipIcon = {};
        this.tooltipIcon.clear = this.buttonClear();
        this.tooltipIcon.accept = this.buttonAccept();
        this.tooltipIcon.zoom = this.buttonZoom();

        if (options.tooltipIcon) {
            var icons = options.tooltipIcon;
            for (var i = 0, len = icons.length; i < len; i++) {
                content.append(this.tooltipIcon[icons[i]]);
            }
        } else {
            content.append(this.tooltipIcon.zoom);
        }
        var id = this.uniqId('tooltip');
        content.attr('id', id);
        this.tooltipId = id;
        this.tooltip = tooltip;

        this.containerElement.append(this.tooltip);
        this.containerElement.attr('data-tooltip-content', '#' + this.tooltipId);
        this.containerElement.tooltipster({
            animation: 'fade',
            delay: 90,
            theme: 'tooltipster-punk',
            trigger: 'hover',
            interactive: 'true',
            side: ['top', 'bottom', 'right', 'left']
        });
        this.topTooltipElement = $('<div style="position: fixed;top: 10px;right: 10px; z-index: 9001"></div>');
        this.topTooltipElement.hide();
        this.containerElement.append(this.topTooltipElement);
    }

    Controller.Widget.prototype.uniqId = function(name) {
        name = (typeof name !== 'undefined') ? name : '';
        return name + (new Date().getTime()) + Math.round(Math.random() * 1000);
    }

    Controller.Widget.prototype.initEvent = function() {
        this.eventListener.add('zoom', this.zoom.bind(this));
    }

    Controller.Widget.prototype.zoom = function(options) {
        if (this.containerElement.hasClass('chartZoom')) {
            this.containerElement.removeClass('chartZoom');
            this.topTooltipElement.html('');
            this.topTooltipElement.hide();
            this.containerElement.tooltipster('enable');
        } else {
            this.containerElement.addClass('chartZoom');
            this.containerElement.tooltipster('disable');
            var clear = this.buttonClear();
            var accept = this.buttonAccept();
            var zoom = this.buttonZoom();
            this.topTooltipElement.append(accept, clear, zoom);
            this.topTooltipElement.show();
        }
        this.draw();
    }

    Controller.GoogleChart = function(options) {
        Controller.Widget.call(this, options);
        var self = this;
        self.canDraw = false;
        self.mustDraw = false;
        self.abc = "test";
        this.initOptions(options);
        if (!isLoadGoogleChart) {
            isLoadGoogleChart = true;
            google.charts.load('42', { 'packages': ['corechart', 'controls', 'map', 'table', 'bar', 'gauge', 'geochart'] });
        }
        google.charts.setOnLoadCallback(function() {
            self.canDraw = true;
            if (self.mustDraw) {
                self.drawGraph(self.dataJson);
                self.mustDraw = false;
            }
        });
        jQuery(window).resize(function() {
            if (!self.containerElement.is(":visible")) {
                jQuery(window).off();
            }
            self.draw();
        });
    }
    Controller.GoogleChart.prototype = Object.create(Controller.Widget.prototype);

    Controller.GoogleChart.prototype.initOptions = function(options) {
        this.options = {
            selectionMode: 'multiple',
            animation: {
                duration: 200,
                easing: 'out'
            },
            backgroundColor: { fill: 'transparent' }
        };
    }

    Controller.GoogleChart.prototype.draw = function(data) {
        data = data || this.dataJson;
        if (!data) return;
        if (this.canDraw) {
            this.drawGraph(data);
        } else {
            this.mustDraw = true;
        }
        this.dataJson = data;
    }


    Controller.GoogleChart.prototype.convertChartDataToGoogleData = function(chartData) {
        if (chartData.length == 1) {
            var len = chartData[0].length;
            var dt = [];
            dt.push('');
            for (var i = 0; i < len - 1; i++) {
                dt.push(0);
            }
            chartData.push(dt);
        }
        return google.visualization.arrayToDataTable(chartData);
    }
    Controller.GoogleChart.prototype.constructor = Controller.GoogleChart;

    // Pie Chart
    Controller.GooglePieChart = function(options) {
        Controller.GoogleChart.call(this, options)
        this.options.chartArea = { 'width': '95%', 'height': '85%' };
        
    }

    Controller.GooglePieChart.prototype = Object.create(Controller.GoogleChart.prototype);

    Controller.GooglePieChart.prototype.drawGraph = function(data) {
        var self = this;
        this.chart = new google.visualization.PieChart(self.contentElement[0]);
        this.data = this.convertChartDataToGoogleData(data);
        this.chart.draw(this.data, this.options);
        //google.visualization.events.addListener(this.chart, 'select', self.selectedChange.bind(self));
    }
    Controller.GooglePieChart.prototype.constructor = Controller.GooglePieChart;

    // Area Chart
    Controller.GoogleAreaChart = function(options) {
        Controller.GoogleChart.call(this, options)
        this.options.chartArea = { 'width': '80%', 'height': '70%' };
        this.options.isStacked = true;
        this.options.legend = { position: 'top', maxLines: 2 }        
    }

    Controller.GoogleAreaChart.prototype = Object.create(Controller.GoogleChart.prototype);

    Controller.GoogleAreaChart.prototype.drawGraph = function(data) {
        var self = this;
        this.chart = new google.visualization.AreaChart(self.contentElement[0]);
        this.data = this.convertChartDataToGoogleData(data);
        this.chart.draw(this.data, this.options);
        //google.visualization.events.addListener(this.chart, 'select', self.selectedChange.bind(self));
    }
    Controller.GoogleAreaChart.prototype.constructor = Controller.GoogleAreaChart;

    // Line
    Controller.GoogleLineChart = function(options) {
        Controller.GoogleChart.call(this, options)
        this.options.chartArea = { 'width': '80%', 'height': '70%' };
        this.options.legend = { position: 'top', maxLines: 2 }
    }

    Controller.GoogleLineChart.prototype = Object.create(Controller.GoogleChart.prototype);

    Controller.GoogleLineChart.prototype.drawGraph = function(data) {
        var self = this;
        this.chart = new google.visualization.LineChart(self.contentElement[0]);
        this.data = this.convertChartDataToGoogleData(data);
        this.chart.draw(this.data, this.options);
        //google.visualization.events.addListener(this.chart, 'select', self.selectedChange.bind(self));
    }
    Controller.GoogleLineChart.prototype.constructor = Controller.GoogleLineChart;

    // Bar chart
    Controller.GoogleBarChart = function(options) {
        Controller.GoogleChart.call(this, options)
        this.options.chartArea = this.options.chartArea || { 'width': '80%', 'height': '70%' };
        this.options.legend = { position: 'top', maxLines: 2 }
    }

    Controller.GoogleBarChart.prototype = Object.create(Controller.GoogleChart.prototype);

    Controller.GoogleBarChart.prototype.drawGraph = function(data) {
        var self = this;
        this.chart = new google.visualization.ColumnChart(self.contentElement[0]);
        this.data = this.convertChartDataToGoogleData(data);
        this.chart.draw(this.data, this.options);
        //google.visualization.events.addListener(this.chart, 'select', self.selectedChange.bind(self));
    }
    Controller.GoogleBarChart.prototype.constructor = Controller.GoogleBarChart;

    // Gauge chart
    Controller.GoogleGaugeChart = function(options) {
        Controller.GoogleChart.call(this, options)
    }

    Controller.GoogleGaugeChart.prototype = Object.create(Controller.GoogleChart.prototype);

    Controller.GoogleGaugeChart.prototype.drawGraph = function(data) {
        var self = this;
        this.chart = new google.visualization.Gauge(self.contentElement[0]);
        this.data = this.convertChartDataToGoogleData(data);
        this.chart.draw(this.data, this.options);
        //google.visualization.events.addListener(this.chart, 'select', self.selectedChange.bind(self));
    }
    Controller.GoogleGaugeChart.prototype.constructor = Controller.GoogleGaugeChart;

    // Geo chart
    Controller.GoogleGeoChart = function(options) {
        Controller.GoogleChart.call(this, options)
    }

    Controller.GoogleGeoChart.prototype = Object.create(Controller.GoogleChart.prototype);

    Controller.GoogleGeoChart.prototype.drawGraph = function(data) {
        var self = this;
        this.chart = new google.visualization.GeoChart(self.contentElement[0]);
        this.data = this.convertChartDataToGoogleData(data);
        this.chart.draw(this.data, this.options);
        //google.visualization.events.addListener(this.chart, 'select', self.selectedChange.bind(self));
    }
    Controller.GoogleGeoChart.prototype.constructor = Controller.GoogleGeoChart;
})(Da);