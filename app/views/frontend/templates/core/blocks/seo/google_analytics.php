<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', '<?php echo $this->setting->google_analytics_id ?>']);
    //_gaq.push(['_setDomainName', 'codefight.org']); @todo::make it dynamic
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

</script>
