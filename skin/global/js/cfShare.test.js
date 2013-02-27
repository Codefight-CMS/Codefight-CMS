/*
 *  Project: Codefight Social Share Bar
 *  Description: Purpose of this plugin is to create a flexible social sharebar
 *  Author: Damodar Bashyal
 *  License: General Public Open Source
 */

;var CodefightShare = {
    version: '0.0.1',
    extensions: {},
    pluginspages: {}
};

(function ($, window, undefined) {

    var cfShare = 'cfShare',
        document = window.document,
        defaults = {
            addthisId:'',
            enableRemove:true,
            enableFloat:true,
            animate:true,
            bgColor:'#fff',
            fromPosition:'original',
            marginFixed:'0 7px 4px -572px',
            border:'1px solid #E5E5E5',
            pageWidth:980,
            shareClients:[],
            shareLeft:-84,
            sharePadding:5,
            shareWidth:70,
            startTop:70,
            topPadding:0,
            url:encodeURIComponent(window.location)
        };

    function CfShare(element, options) {
        $(element).html('<div class="cfshare"></div>');
        this.element = $('.cfshare');

        this.options = $.extend({}, defaults, options);

        this._defaults = defaults;
        this._name = cfShare;

        this.init();
    }

    CfShare.prototype = {
        init:function () {
            var $newHTML = this.element.html('<div id="cfShareClients"><div id="cfShareClientsFloat" style="display: none;"></div><div id="cfShareClientsOriginal" style="display: none;"></div></div><div id="cfShareStyle"></div><div id="cfShareJs"></div>');
            var $cfShareJs = $newHTML.find('#cfShareJs');
            this.reposition();
        },
        scroll:function () {
            this.reposition();
        },
        cssCommon:function () {
            var $stylesheet = '<style type="text/css">' +
                '#sharebox .cfshare {z-index: 1000;}' +
                '.fb_iframe_widget iframe {left: 0;position: absolute;top: 0;z-index: 1;}' +
                '</style>';
            $('div#cfShareStyle').append($stylesheet);
        },
        cssFloat:function () {
            this.element.removeAttr('style');
            var $stylesheet = '<style type="text/css">' +
                '#sharebox {background: #fff;position: relative;-moz-border-radius: 5px;border-radius: 5px;text-align: center;}' +
                '#sharebox .cfshare {left: ' + this.options.shareLeft + 'px;width: ' + this.options.shareWidth + 'px;padding: 5px;position: absolute;top: 0;background-color: #FAFAFA;border: ' + this.options.border + ';}' +
                '#sharebox .cfshare:hover {background-color: ' + this.options.bgColor + ';box-shadow: 0 0 4px rgba(0, 0, 0, 0.1);}' +
                '.cfBtnFloatDownload {bottom: 0;display: block;height: 22px;margin: 10px 0 0;position: absolute;width: 71px;}' +
                '.cfBtnFloatDownload {display: block;margin: 10px 0 0;}' +
                '.cfBtnFloatDownload a {background: #DEDEDE;border: 1px solid #FAFAFA;color: #FBFBFB;display: block;font-size: 11px;text-decoration: none;}' +
                '.cfBtnFloatDownload a:hover {color: #693;}' +
                '.sepFloat{display: block;height: 5px;overflow: hidden;}' +
                '.addthisFrap{display: block; text-align: center; margin: 0 auto; width: 50px;}' +
                '#cfShareClientsFloat a.addthis_button_tweet{width: 70px;}' +
                '.at300b,.at300b:hover{opacity: 1;}' +
                '.cfBtnFloatRdt{}' +
                '#cfShareClientsFloat{padding: 0 0 20px;}' +
                '.cfBtnFloatHide{}' +
                '.cfBtnFloatHide a {display: block;background: #eee;font-size: 11px;line-height: 14px;margin: 0px 0 2px;}' +
                '</style>';
            $('div#cfShareStyle').html($stylesheet);
            this.cssCommon();
        },
        cssOriginal:function () {
            this.element.removeAttr('style');
            var $stylesheet = '<style type="text/css">' +
                '#sharebox {background: #fff;position: relative;-moz-border-radius: 5px;border-radius: 5px;margin-bottom: 15px;}' +
                '#sharebox .cfshare {padding: 5px;background-color: ' + this.options.bgColor + ';border: ' + this.options.border + ';min-height: 20px;}' +
                '#sharebox .cfshare:hover {background-color: ' + this.options.bgColor + ';box-shadow: 0 0 4px rgba(0, 0, 0, 0.1);}' +
                '.cfBtnOrig{float: left;}' +
                '.addthisOrap{margin-right: 10px;}' +
                '.at300b,.at300b:hover{opacity: 1;}' +
                '.cfBtnOrigRdt, .cfBtnOrigLn{float:left;}' +
                '</style>';
            $('div#cfShareStyle').html($stylesheet);
            this.cssCommon();
        },
        animateBar:function (top) {
            if (this.options.animate === true) {
                this.element.stop().animate({
                    top:top
                });
            } else {
                this.element.css({
                    'padding':this.options.sharePadding,
                    'top':(($(window).scrollTop() > this.options.startTop) ? 0 : this.options.startTop),
                    'position':'fixed',
                    'margin':this.options.marginFixed,
                    'left':'50%' /*(((options.shareLeft * (-1))+options.shareWidth)-options.sharePadding)*/
                });
            }
        },
        reposition:function ($o) {
            $o = $.extend({}, this.options, $o);
            var $gap = (($(window).width() - $o.pageWidth));

            if ($gap > 135) {
                this.cssFloat();
                $('#cfShareClientsFloat:hidden').show();
                $('#cfShareClientsOriginal:visible').hide();
                var $thisTop = this.element.offset().top;

                switch ($o.fromPosition) {
                    case 'top':
                        if ($(window).scrollTop() > $o.startTop) {
                            this.animateBar($(window).scrollTop() - $thisTop + $o.topPadding);
                        } else {
                            this.animateBar($o.startTop - $thisTop);
                        }
                        break;
                    default:
                        if ($(window).scrollTop() > $thisTop) {
                            this.animateBar($(window).scrollTop() - $thisTop + $o.topPadding);
                        } else {
                            this.animateBar(0);
                        }
                        break;
                }
            } else {
                this.cssOriginal();
                $('#cfShareClientsOriginal:hidden').show();
                $('#cfShareClientsFloat:visible').hide();
            }

            this.element.css({overflow:'visible'});
        }
    };

    $.fn[cfShare] = function (options) {
        return this.each(function () {
            if (!$.data(this, 'plugin_' + cfShare)) {
                $.data(this, 'plugin_' + cfShare, new CfShare(this, options));
            }
        });
    };

    $(window).scroll(function() {
        //$.cfShare().reposition();
        //this.reposition();
    });
}(jQuery, window));
