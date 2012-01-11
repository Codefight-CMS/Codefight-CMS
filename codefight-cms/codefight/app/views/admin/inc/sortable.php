<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<script type="text/javascript" language="javascript">
    jQuery(document).ready(
            function($) {
                jQuery("#sortme").Sortable({
                    accept : 'sortitem',
                    onchange : function (sorted) {
                        serial = $.SortSerialize('sortme');


                        $.ajax({
                            url: "<?php echo site_url(); ?>admin/sortdata/<?php echo $this->uri->segment(2, 0); ?>",
                            type: "POST",
                            data: serial.hash,
                            //table: "",
                            // complete: function(){},
                            //success: function(feedback){ jQuery('#data').html(feedback); }
                            // error: function(){}
                        });
                    }
                });
            }
    );
</script>