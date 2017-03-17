window.Da = window.Da || {};

(function(Controller) {
    Controller.Event = function() {
        this.listEvent = {};
    }

    Controller.Event.prototype.add = function(name, func) {
        if (!this.listEvent[name]) {
            this.listEvent[name] = [];
        }
        this.listEvent[name].push(func);
    }

    Controller.Event.prototype.execute = function(name) {
        if (this.listEvent[name]) {
            for (var i = 0, len = this.listEvent[name].length; i < len; i++) {
                this.listEvent[name][i]();
            }
        }
    }
})(Da);