<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<script>
    if(hljs!=undefined){
        hljs.initHighlightingOnLoad();
        if(jQuery != undefined){
            var $j = jQuery;
            $j(document).ready(
                function () {
                    //hljs.configure({useBR: true});

                    var $codes = $j('pre.brush\\:');
                    if($codes.length){
                        $codes.each(function(i, block) {
                            hljs.highlightBlock(block);
                        });
                    }
                }
            );
        }
    }
</script>
