/*General javascripts*/

//Hide Javascript enable message
jQuery(document).ready(function($){
	$('#js_disabled').hide('fast');

	//Left menu Toggle
	$('.menuLeft div h2').click(function(){
		//----
		$(this).parent().find('ul').slideToggle(500);
	});

	//Right menu Toggle
	$('.right_column div h2').click(function(){
		//----
		$(this).parent().find('ul').slideToggle(500);
	});
});

function language_selection() {
	/*Toggle Language Selection Bar*/
	jQuery('#languages').slideToggle();
}

function show_downloads() {
	/*Toggle Language Selection Bar*/
	jQuery('#downloads').slideToggle();
}


//Mark site as adult, which will hide content for that site
function flag_adult(a) {
	jQuery.post(
		'index.php/ontheweb/page/flag-adult/' + a,
		{
			site: a
		},
		function(data){
			if(data!=''){
				alert(data);
				window.location.replace(window.location.href);
			}else{
				alert('got some error processing request.');
			}
		}
	);
}


//Remove Site From On the web listing.
function remove_site(a) {
	jQuery.post(
		'index.php/ontheweb/page/remove-site/' + a,
		{
			site: a
		},
		function(data){
			if(data!=''){
				alert(data);
				//window.location.replace(window.location.href);
			}else{
				alert('got some error processing request.');
			}
		}
	);
}

SyntaxHighlighter.all();

