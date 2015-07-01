/* =========================================================
 * jquery.vc_chart.js v1.0
 * =========================================================
 * Copyright 2013 Wpbakery
 *
 * Jquery chart plugin for the Visual Composer.
 * ========================================================= */
(function($){

// Copyright 2006 Google Inc.
//
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
//   http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.


    /**
     * Pie chart animated.
     * @param element - DOM element
     * @param options - settings object.
     * @constructor
     */
    var VcChart = function(element, options) {
        this.el = element;
        this.$el = $(this.el);
        this.options = $.extend({
            color: 'wpb_button',
            units: '',
            label_selector: '.vc_pie_chart_value',
            back_selector: '.vc_pie_chart_back',
            responsive: true
        }, options);
       
            this.init();
       
    };
    VcChart.prototype = {//changed color
        constructor: VcChart,
        _progress_v: 0,
        animated: false,
        colors: {
            'wpb_button': 'rgba(142, 147, 151, 1)',
            'btn-primary': 'rgba(42, 130, 236, 1)',
            'btn-info': 'rgba(24, 199, 225, 1)',
            'btn-success': 'rgba(106, 206, 25, 1)',
            'btn-warning': 'rgba(255, 109, 30, 1)',
            'btn-danger': 'rgba(238, 40, 63, 1)',
            'btn-inverse': 'rgba(50, 54, 58, 1)',
            'btn-custom' : dtGlobals.customColor
        },
        init: function() {
            this.setupColor();
            this.value = this.$el.data('pie-value')/100;
            this.label_value = this.$el.data('pie-label-value') || this.$el.data('pie-value');
            this.$wrapper = $('.vc_pie_wrapper', this.$el);
            this.$label = $(this.options.label_selector, this.$el);
            this.$back = $(this.options.back_selector, this.$el);
           
                this.$canvas = this.$el.find('canvas');
            this.draw();
            this.setWayPoint();
            if(this.options.responsive === true) this.setResponsive();

        },
        setupColor: function() {
            if(typeof this.colors[this.options.color] !== 'undefined') {
                this.color = this.colors[this.options.color];
            } else if(typeof this.options.color === 'string' && this.options.color.match(/^rgb(a?)\([^\)]\)/)) {
                this.color = this.options.color;
            } else {
                this.color = 'rgba(247, 247, 247, 0.2)';
            }
        },
        setResponsive: function() {
            var that = this;
            $(window).resize(function(){
                
                    if(that.animated === true) that.circle.stop();
               
                that.draw(true);
            });
        },
        draw: function(redraw) {
            var w = this.$el.width()/100*80,
                border_w = 5,
                radius = w/2 - border_w - 1;
            this.$wrapper.css({"width" : w + "px"});
            this.$label.css({"width" : w, "height" : w, "line-height" : w+"px"});
            this.$back.css({"width" : w, "height" : w});
           
                this.$canvas.attr({"width" : w + "px", "height" : w + "px"}); 
                this.circle = new ProgressCircle({
                    canvas: this.$canvas.get(0),
                    minRadius: radius,
                    arcWidth: border_w
                });
                if(redraw === true && this.animated === true) {
                    this._progress_v = this.value;
                    this.circle.addEntry({
                        fillColor: this.color,
                        progressListener: $.proxy(this.setProgress, this)
                    }).start();
                }
           
        },
        setProgress: function() {
            if (this._progress_v >= this.value) {
                this.circle.stop();
                this.$label.html(this.label_value + '<span class="vc_pie_chart_value-inner">' + this.options.units + '<span>');
                return this._progress_v;
            }
            this._progress_v += 0.005;
            var label_value = this._progress_v/this.value*this.label_value;
            var val = Math.round(label_value) + this.options.units ;
            this.$label.html(val);
            return this._progress_v;
        },
        animate: function() {
            if(this.animated !== true) {
                this.animated = true;
               
                this.circle.addEntry({
                    fillColor: this.color,
                    progressListener: $.proxy(this.setProgress, this)
                }).start(5);
                
            }
        },
        setWayPoint: function() {
            if (typeof $.fn.waypoint !== 'undefined') {
                this.$el.waypoint($.proxy(this.animate, this), { offset: '85%' });
            } else {
                this.animate();
            }
        }
    };
    /**
     * jQuery plugin
     * @param option - object with settings
     * @return {*}
     */
    $.fn.vcChat = function(option) {
        return this.each(function () {
            var $this = $(this),
                data = $this.data('vc_chart'),
                options = typeof option === 'object' ? option : {
                    color: $this.data('pie-color'),
                    units: $this.data('pie-units')
                };
            if (!data) $this.data('vc_chart', (data = new VcChart(this, options)));
            if (typeof option == 'string') data[option]();
        });
    };
    /**
     * Allows users to rewrite function inside theme.
     */
    if ( typeof window['vc_pieChart'] !== 'function' ) {
        window.vc_pieChart = function() {
            $('.vc_pie_chart').vcChat();
        }
    }
    $(document).ready(function(){
        vc_pieChart();
    });
})(window.jQuery);