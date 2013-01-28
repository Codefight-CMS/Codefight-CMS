jQuery(document).ready(function($) {
	equalHeight($(".item p"));
	$(".home_widgets .widget:first").css("margin-left", "0");
	$(".footernav  li:last").css("border-right", "0");
	$(".navigation .alignleft:empty").hide();
	$(".navigation .alignright:empty").hide();
	$(".comment-nav .alignright:empty").hide();
	$(".comment-nav .alignleft:empty").hide();
	$(".navigation:empty").hide();
	$(".comment-nav:empty").hide();
	$('ul.sf-menu').superfish();
});

DD_roundies.addRule('#header, #footer, .container, .qbutton a, blockquote,.comment-reply-link', '10px', true);
DD_roundies.addRule('#sidebarsearch div, .navigation a, .comment-nav a', '20px', true);
DD_roundies.addRule('.wp-caption,.portfnav a', '5px', true);
DD_roundies.addRule('.commentlist li', '10px', true);
Cufon.replace('#pagenav a', {
	textShadow: '1px 1px #ffffff'
});

Cufon.replace('h1');
Cufon.replace('h2');
Cufon.replace('h3');
Cufon.replace('h4');
Cufon.replace('h5');

function equalHeight(group) {
	tallest = 0;
	group.each(function() {
		thisHeight = $(this).height();
		if(thisHeight > tallest) {
			tallest = thisHeight;
		}
	});
	group.height(tallest);
}