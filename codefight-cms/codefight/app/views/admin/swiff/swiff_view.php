<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php  $this->load->view('admin/inc/template_top'); ?>
	<script type="text/javascript">
	/* <![CDATA[ */
	/**
	 * FancyUpload Showcase
	 *
	 * @license		MIT License
	 * @author		Harald Kirschner <mail [at] digitarald [dot] de>
	 * @copyright	Authors
	 */
	 
	/**
 * FancyUpload Showcase
 *
 * @license		MIT License
 * @author		Harald Kirschner <mail [at] digitarald [dot] de>
 * @copyright	Authors
 */
 
window.addEvent('domready', function() { // wait for the content
 
	// our uploader instance 
 
	var up = new FancyUpload2($('demo-status'), $('demo-list'), { // options object
		// we console.log infos, remove that in production!!
		verbose: true,
 
		// url is read from the form, so you just have to change one place
		url: $('form-demo').action,
 
		// path to the SWF file
		path: '<?php echo base_url() ?>assets/admin/swf/Swiff.Uploader.swf',
 		
		method: 'post',

		// remove that line to select all files, or edit it, add more items
		typeFilter: {
			'Images (*.jpg, *.jpeg, *.gif, *.png)': '*.jpg; *.jpeg; *.gif; *.png'
		},
 
		// this is our browse button, *target* is overlayed with the Flash movie
		target: 'demo-browse',
 
		// graceful degradation, onLoad is only called if all went well with Flash
		onLoad: function() {
			$('demo-status').removeClass('hide'); // we show the actual UI
			$('demo-fallback').destroy(); // ... and hide the plain form
			//alert(url);
 
			// We relay the interactions with the overlayed flash to the link
			this.target.addEvents({
				click: function() {
					return false;
				},
				mouseenter: function() {
					this.addClass('hover');
				},
				mouseleave: function() {
					this.removeClass('hover');
					this.blur();
				},
				mousedown: function() {
					this.focus();
				}
			});
 
			// Interactions for the 2 other buttons
 
			$('demo-clear').addEvent('click', function() {
				up.remove(); // remove all files
				return false;
			});
 
			$('demo-upload').addEvent('click', function() {
				up.start(); // start upload
				return false;
			});
		},
 
		// Edit the following lines, it is your custom event handling
 
		/**
		 * Is called when files were not added, "files" is an array of invalid File classes.
		 * 
		 * This example creates a list of error elements directly in the file list, which
		 * hide on click.
		 */ 
		onSelectFail: function(files) {
			files.each(function(file) {
				new Element('li', {
					'class': 'validation-error',
					html: file.validationErrorMessage || file.validationError,
					title: MooTools.lang.get('FancyUpload', 'removeTitle'),
					events: {
						click: function() {
							this.destroy();
						}
					}
				}).inject(this.list, 'top');
			}, this);
		},
 
		/**
		 * This one was directly in FancyUpload2 before, the event makes it
		 * easier for you, to add your own response handling (you probably want
		 * to send something else than JSON or different items).
		 */
		onFileSuccess: function(file, response) {
			var json = new Hash(JSON.decode(response, true) || {});
 
			if (json.get('status') == '1') {
				file.element.addClass('file-success');
				file.info.set('html', '<strong>Image was uploaded:</strong> ' + json.get('width') + ' x ' + json.get('height') + 'px, <em>' + json.get('mime') + '</em>)');
			} else {
				file.element.addClass('file-failed');
				file.info.set('html', '<strong>An error occured:</strong> ' + (json.get('error') ? (json.get('error') + ' #' + json.get('code')) : response));
			}
		},
 
		/**
		 * onFail is called when the Flash movie got bashed by some browser plugin
		 * like Adblock or Flashblock.
		 */
		onFail: function(error) {
			switch (error) {
				case 'hidden': // works after enabling the movie and clicking refresh
					alert('To enable the embedded uploader, unblock it in your browser and refresh (see Adblock).');
					break;
				case 'blocked': // This no *full* fail, it works after the user clicks the button
					alert('To enable the embedded uploader, enable the blocked Flash movie (see Flashblock).');
					break;
				case 'empty': // Oh oh, wrong path
					alert('A required file was not found, please be patient and we fix this.');
					break;
				case 'flash': // no flash 9+ :(
					alert('To enable the embedded uploader, install the latest Adobe Flash plugin.')
			}
		}
 
	});
 
});
	/* ]]> */
	</script>

	<h1>Upload Manager</h1>
	
	<?php echo form_open_multipart('admin/swiff/process-upload', array('id'=>'form-demo', 'method'=>'post')); ?>
	<div class="page_grid">
		<p>You can now upload any files* you may have. All images and pdfs will be uploaded to their respective folders.</p>
		<p><span style="text-decoration:underline; font-weight:bold;">Files:</span> * Files must be .pdf, .jpg, .jpeg or .gif format.  Files can be no larger than 2mb.</p>
 
	<fieldset id="demo-fallback">
		<legend>File Upload</legend>
		<p>
			This form is just an example fallback for the unobtrusive behaviour of FancyUpload.
			If this part is not changed, something must be wrong with your code.
		</p>
		<label for="demo-photoupload">
			Upload a Photo:
			<input type="file" name="Filedata" />
		</label>
	</fieldset>
 
	<div id="demo-status" class="hide">
		<p>
			<a href="#" id="demo-browse">Browse Files</a> |
			<a href="#" id="demo-clear">Clear List</a> |
			<a href="#" id="demo-upload">Start Upload</a>
		</p>
		<div>
			<strong class="overall-title"></strong><br />
			<img src="<?php echo base_url(); ?>assets/admin/img/bar.gif" class="progress overall-progress" />
		</div>
		<div>
			<strong class="current-title"></strong><br />
			<img src="<?php echo base_url(); ?>assets/admin/img/bar.gif" class="progress current-progress" />
		</div>
		<div class="current-text"></div>
	</div>
 
	<ul id="demo-list"></ul>
	</div>
	<?php echo form_close(); ?>
		
<?php $this->load->view('admin/inc/template_bottom'); ?>