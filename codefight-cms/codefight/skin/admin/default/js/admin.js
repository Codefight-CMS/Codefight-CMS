jQuery(document).ready(function(){
    jQuery("ul#main-nav li").find("ul").children(".current").parents('li').addClass('active');
    jQuery("ul#main-nav li").hover(
        function() {
            $ul = jQuery(this).find("ul.child").css('overflow', 'visible');
            $ul.stop()
                    .slideDown('fast')
                    .show()
                    .parent()
                    .addClass('over');
            $ul.find('li').hover(
                    function()
                    {
                        $cul = jQuery(this).find("ul.grand-child").css('overflow', 'visible');
                        $cul.not(':visible')
                                .stop()
                                .slideDown('fast')
                                .show()
                                //.css('overflow', 'visible')
                                ;
                    },
                    function()
                    {
                        jQuery(this).find("ul.grand-child")
                                .stop()
                                .slideUp('fast');//.hide();
                    }
            );
        },
        function () {
            $ul = jQuery(this).find("ul.child");
            $ul.stop()
                    .slideUp('fast')
                    .parent()
                    .removeClass('over');//.hide();
            //$ul.css('overflow', 'visible');
        }
    );
	
	jQuery('body').addClass('admin');
});
