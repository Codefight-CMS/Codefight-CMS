(function ($, windows, undefined) {
    $(document).ready(function(){
        var li = $("ul#main-nav li");
        li.find("ul").children(".current").parents('li').addClass('active');
        li.hover(
            function() {
                var ul = $(this).find("ul.child").css('overflow', 'visible');
                ul.stop()
                    .slideDown('fast')
                    .show()
                    .parent()
                    .addClass('over');
                ul.find('li').hover(
                    function()
                    {
                        $cul = $(this).find("ul.grand-child").css('overflow', 'visible');
                        $cul.not(':visible')
                            .stop()
                            .slideDown('fast')
                            .show()
                        //.css('overflow', 'visible')
                        ;
                    },
                    function()
                    {
                        $(this).find("ul.grand-child")
                            .stop()
                            .slideUp('fast');//.hide();
                    }
                );
            },
            function () {
                ul = $(this).find("ul.child");
                ul.stop()
                    .slideUp('fast')
                    .parent()
                    .removeClass('over');//.hide();
                //ul.css('overflow', 'visible');
            }
        );

        $('body').addClass('admin');

        var selectAll = $('#select_all');
        selectAll.change(function () {
            $('input.checkbox_select_all').prop('checked', $(this).prop("checked"));
        });
    });

})(jQuery, window);