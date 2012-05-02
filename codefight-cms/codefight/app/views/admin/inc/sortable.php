<?php if (!defined('BASEPATH')) {
    exit(__('No direct script access allowed'));
} ?>
<script type="text/javascript" language="javascript">
    jQuery(document).ready(
        function ($) {
            jQuery("#sortme").sortable({
                items: "li:not(#exclude)",
                accept:'li.sortitem',
                update:function () {
                    $.ajax(
                        {
                            type:"POST",
                            url:"<?php echo site_url(); ?>admin/sortdata/<?php echo $this->uri->segment(2, 0); ?>",
                            data:{
                                //serial = $.SortSerialize('sortme');
                                sortme:$("#sortme").sortable('toArray')
                            },
                            success:function (html) {
                                //$('.success').fadeIn(500);
                                //$('.success').fadeOut(500);
                            }
                        });
                }
            }).disableSelection();
        }
    );
</script>
