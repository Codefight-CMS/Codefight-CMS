/**
 * Created by Damodar Bashyal
 * User: damu
 * Date: 1/10/11
 * Time: 3:24 PM
 * Package: codefight cms share buttons
 * CD C:\wamp\www\codefight-lab-git\trunk\codefight\skin\global\js
 * java -jar compiler.jar --js share.js --js_output_file share.mini.js
 * http://closure-compiler.googlecode.com/files/compiler-latest.zip
 * Doc: http://codefight.org/blog/0/119/Social-Share-Plugin
 */
;(function($, window, undefined){
    $.fn.extend({
        cfShare: function(options) {

            var defaults = {
                addthisId       : '',
                enableRemove    : true,
                enableFloat     : true,
                animate         : true,
                bgColor         : '#fff',
                fromPosition    : 'original',
				marginFixed		: '0 7px 4px -572px',
				border			: '1px solid #E5E5E5',
                pageWidth       : 980,
                shareClients    : [],
                shareLeft       : -84,
                sharePadding    : 5,
                shareWidth      : 70,
                startTop        : 70,
                topPadding      : 0,
                url             : encodeURIComponent(window.location)
            };

            var options = $.extend(defaults, options);
            var $this = this;
            var $cfshare = $this.find('.cfshare');
            var $newHTML = $cfshare.html('<div id="cfShareClients"><div id="cfShareClientsFloat" style="display: none;"></div><div id="cfShareClientsOriginal" style="display: none;"></div></div><div id="cfShareStyle"></div><div id="cfShareJs"></div>');
			var $cfShareJs = $newHTML.find('#cfShareJs');

            function functionName(str)
            {
                var str = str.toString().toLowerCase().replace(/(?:^|\s)\w/g, function(match) {
                    return match.toUpperCase();
                });

                return 'cf' + str;
            }

            function shareClients()
            {
                var $fn;
                $.each(options.shareClients, function() {
                    $fn = functionName(this);
                    try{
                        $this[$fn]();
                        $('#cfShareClientsFloat').append('<span class="sepFloat"></span>');
                    }catch(e){
                        console.log($fn + ' is not a function');
                    }
                });
            }

            function cssCommon()
            {
                var $stylesheet = '<style type="text/css">' +
                        '#sharebox .cfshare {z-index: 1000;}' +
                        '.fb_iframe_widget iframe {left: 0;position: absolute;top: 0;z-index: 1;}' +
                        '</style>';
                $('div#cfShareStyle').append($stylesheet);
            }

            function cssFloat()
            {
                var $stylesheet = '<style type="text/css">' +
                        '#sharebox {background: #fff;position: relative;-moz-border-radius: 5px;border-radius: 5px;text-align: center;}' +
                        '#sharebox .cfshare {left: '+options.shareLeft+'px;width: '+options.shareWidth+'px;padding: 5px;position: absolute;top: 0;background-color: #FAFAFA;border: '+options.border+';}' +
                        '#sharebox .cfshare:hover {background-color: '+options.bgColor+';box-shadow: 0 0 4px rgba(0, 0, 0, 0.1);}' +
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
                cssCommon();
            }

            function cssOriginal()
            {
                $cfshare.removeAttr('style');
                var $stylesheet = '<style type="text/css">' +
                        '#sharebox {background: #fff;position: relative;-moz-border-radius: 5px;border-radius: 5px;margin-bottom: 15px;}' +
                        '#sharebox .cfshare {padding: 5px;background-color: '+options.bgColor+';border: '+options.border+';min-height: 20px;}' +
                        '#sharebox .cfshare:hover {background-color: '+options.bgColor+';box-shadow: 0 0 4px rgba(0, 0, 0, 0.1);}' +
                        '.cfBtnOrig{float: left;}' +
                        '.addthisOrap{margin-right: 10px;}' +
                        '.at300b,.at300b:hover{opacity: 1;}' +
                        '.cfBtnOrigRdt, .cfBtnOrigLn{float:left;}' +
                        '</style>';
                $('div#cfShareStyle').html($stylesheet);
                cssCommon();
            }

            function animateBar(top)
            {
                if(options.animate === true)
                {
                    $cfshare.stop().animate({
                        top: top
                    });
                } else {
                    $cfshare.css({
                        'padding'   : options.sharePadding,
                        'top'       : (($(window).scrollTop() > options.startTop) ? 0 : options.startTop),
                        'position'  : 'fixed',
                        'margin'    : options.marginFixed,
                        'left'      : '50%' /*(((options.shareLeft * (-1))+options.shareWidth)-options.sharePadding)*/
                    });
                }
            }

            function reposition()
            {
                var $gap = (($(window).width()-options.pageWidth));

                if($gap > 135)
                {
                    cssFloat();
                    $('#cfShareClientsFloat:hidden').show();
                    $('#cfShareClientsOriginal:visible').hide();
                    var $thisTop = $this.offset().top;

                    switch(options.fromPosition)
                    {
                        case 'top':
                            if ($(window).scrollTop() > options.startTop) {
                                animateBar($(window).scrollTop() - $thisTop + options.topPadding);
                            } else {
                                animateBar(options.startTop - $thisTop);
                            }
                            break;
                        default:
                            if ($(window).scrollTop() > $thisTop) {
                                animateBar($(window).scrollTop() - $thisTop + options.topPadding);
                            } else {
                                animateBar(0);
                            }
                            break;
                    }
                } else {
                    cssOriginal();
                    $('#cfShareClientsOriginal:hidden').show();
                    $('#cfShareClientsFloat:visible').hide();
                }

                $cfshare.css({overflow: 'visible'});
            }

            function getButton(url, loc, asink)
            {
                var $string = '<script type="text/javascript">(function(){var cfgb = document.createElement(\'script\'); cfgb.type = \'text/javascript\';'+((loc == null || asink == '1')?'cfgb.async = true;':'')+ 'cfgb.src = (\'https:\' == document.location.protocol ? \'https://\' : \'http://\')+\'' + url + '\';';

                if(loc == null){
                    $string += 'var cfs = document.getElementsByTagName(\'script\')[0]; cfs.parentNode.insertBefore(cfgb,cfs);';
                }else{
                    $string += 'var cfs = document.getElementById(\''+loc+'\'); cfs.appendChild(cfgb);';
                }

                $string += '})()</script>';

                return $string;
            }

            $(window).scroll(function() {
                reposition();
            });

            $(window).resize(function() {
                reposition();
            });

            $this.cfFacebook = function()
            {
                $('#cfShareClientsOriginal').append('<a class="addthis_button_facebook_like cfBtnOrig" fb:like:layout="button_count"></a>');
				if(options.enableFloat)
				{
					$('#cfShareClientsFloat').append('<a class="addthis_button_facebook_like cfBtnFloat" fb:like:layout="box_count"></a>');
				}
            }

            $this.cfFacebooksend = function()
            {
                $('#cfShareClientsOriginal').append('<a class="addthis_button_facebook_send cfBtnOrig"></a>');
                if(options.enableFloat)
				{
					$('#cfShareClientsFloat').append('<a class="addthis_button_facebook_send cfBtnFloat"></a>');
				}
            }

            $this.cfTwitter = function()
            {
                $('#cfShareClientsOriginal').append('<a class="addthis_button_tweet cfBtnOrig"></a>');
                if(options.enableFloat)
				{
					$('#cfShareClientsFloat').append('<a class="addthis_button_tweet cfBtnFloat" tw:count="vertical"></a>');
				}
            }

            $this.cfGoogleplusone = function()
            {
                $('#cfShareClientsOriginal').append('<a class="addthis_button_google_plusone cfBtnOrig" g:plusone:size="medium"></a>');
                if(options.enableFloat)
				{
					$('#cfShareClientsFloat').append('<a class="addthis_button_google_plusone cfBtnFloat" g:plusone:size="tall"></a>');
				}
            }

            $this.cfAddthis = function()
            {
                $('#cfShareClientsOriginal').append('<a class="addthis_counter addthis_pill_style cfBtnOrig addthisOrap"></a>');
                if(options.enableFloat)
				{
					$('#cfShareClientsFloat').append('<a class="addthis_counter cfBtnFloat addthisFrap"></a>');
				}
            }

            $this.cfDigg = function()
            {
                $cfShareJs.append('<script src="http://widgets.digg.com/buttons.js" type="text/javascript"></script>');
                $('#cfShareClientsOriginal').append('<a class="DiggThisButton DiggCompact cfBtnOrig"></a>');
                if(options.enableFloat)
				{
					$('#cfShareClientsFloat').append('<a class="DiggThisButton DiggMedium cfBtnFloat"></a>');
				}
            }

            $this.cfReddit = function()
            {
                $('#cfShareClientsOriginal').append('<div class="cfBtnOrigRdt"><a href="http://www.reddit.com/submit?url='+options.url+'" onclick="window.location = \'http://www.reddit.com/submit?url=\' + encodeURIComponent(window.location); return false"><img src="http://www.reddit.com/static/spreddit7.gif" alt="submit to reddit" border="0"></a></div><span class="sepOrig"></span>');

				if(options.enableFloat)
				{
					$('#cfShareClientsFloat').append('<div class="cfBtnFloatRdt" id="cfBtnFloatRdt">').append(getButton('www.reddit.com/static/button/button2.js', 'cfBtnFloatRdt', '1')).append('</div>');
				}
            }

            $this.cfLinkedin = function()
            {
                $cfShareJs.append(getButton('platform.linkedin.com/in.js', null));
                $('#cfShareClientsOriginal').append('<div class="cfBtnOrigLn" id="cfBtnOrigLn"><script type="IN/Share" data-counter="right"></script></div><span class="sepOrig"></span>');

				if(options.enableFloat)
				{
					$('#cfShareClientsFloat').append('<div class="cfBtnFloatLn">').append('<script type="IN/Share" data-counter="top"></script>').append('</div>');
				}
            }

            $cfShareJs.append('<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid='+options.addthisId+'"></script>');

            $(document).ready(function(){shareClients();reposition();});

            if(options.enableFloat)
			{
					$('#cfShareClientsFloat').append('<div class="cfBtnFloatDownload"><a target="_blank" href="http://codefight.org/blog/0/119/Social-Share-Plugin?ref='+window.location.hostname+'">share bar</a></div>');
			}

            if(options.enableRemove)
			{
					$('#cfShareClientsFloat').prepend('<div class="cfBtnFloatHide"><a href="javascript:void(0);" onclick="jQuery(\'#sharebox\').remove();">remove</a></div>');
			}
        }
    });
})(jQuery,window);
