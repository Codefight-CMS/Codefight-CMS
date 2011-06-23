<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
	<script type="text/javascript">
	/* <![CDATA[ */
	window.addEvent('load', function() {
		var swiffy = new FancyUpload2($('demo-status'), $('demo-list'), {
			url: $('form-demo').action,
			fieldName: 'photoupload',
			limitFiles: '50',
			path: 'assets/common/swf/Swiff.Uploader.swf',
			onLoad: function() {
				$('demo-status').removeClass('hide');
				$('demo-fallback').destroy();
			},
			onComplete: function() {
				//getCSV('csv-preview-table', '<?php echo session_id()?>');
				//getObject('csv-preview-table').style.display	= 'block';
				//getObject('csv-submit').style.display			= 'block';
			},
			debug: true,
			target: 'demo-browse-all' // the element for the overlay (Flash 10 only)
		});
		
		var filter					= null;
			
		filter						= {'File Types (*.jpg, *.jpeg, *.gif)': '*.jpg; *.jpeg; *.gif;'};
		swiffy.options.typeFilter 	= filter;
	
		$('demo-browse-all').addEvent('click', function() {
			/*var filter = null;
			if (this.checked) {
				filter = {'File Type (*.csv)': '*.csv;'};
			}
			swiffy.options.typeFilter = filter;*/
			
			//swiffy.browse({'File Type (*.csv)': '*.csv;'});
			if (filter!=null) swiffy.browse();
			return false;
		});
		
		/*$('demo-browse-all').addEvent('change', function() {
			var filter = null;
			if (this.checked) {
				filter = {'File Type (*.csv)': '*.csv;'};
			}
			swiffy.options.typeFilter = filter;
		});*/
	
		$('demo-clear').addEvent('click', function() {
			swiffy.removeFile();
			return false;
		});
	
		$('demo-upload').addEvent('click', function() {
			swiffy.upload();
			return false;
		});
	
	});
	/* ]]> */
	</script>
