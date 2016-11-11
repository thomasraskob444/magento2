define([
    "jquery",
    "jquery/ui"
], function($) {
    "use strict";

    //creating jquery widget
    $.widget('timer.js', {
        intervalId: null,
        tickCount: null,
        startTime: null,
        endTime: null,

        _create: function() {
            this.startTime = new Date(this.options.startTimeString);
            this.endTime = new Date(this.options.endTimeString);

            this.tickCount = 0;
            this.intervalId = setInterval(this._tick.bind(this), 1000);
        },

        _tick: function() {
            var now = new Date();
            if (now <= this.endTime) {
                var diff = this.endTime - now;
                var h = parseInt(diff / (3600 * 1000));
                var m = parseInt(diff / (60*1000)) - h * 60;
                var s = parseInt(diff / 1000) - h * 3600 - m * 60;
                jQuery(this.element).find("#remaining-time").text(h + "Hrs " + m + "Mins " + s + "Secs");
            } else {
                // jQuery(this.element).text("ENDED");
                // clearInterval(this.intervalId);
            }


            if (this.tickCount++ == 100) {
                jQuery(this.element).text("ENDED");
                clearInterval(this.intervalId);
            }
        }

    });

    return $.timer.js;
});