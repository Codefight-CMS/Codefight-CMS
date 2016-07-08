/*General javascripts*/
;(function( $, window, document, undefined ){
//Hide Javascript enable message
$(document).ready(function(){
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

    //Hide JS required warning
    $('#js_req').hide();
});

function language_selection() {
    /*Toggle Language Selection Bar*/
    $('#languages').slideToggle();
}

function show_downloads() {
    /*Toggle Language Selection Bar*/
    $('#downloads').slideToggle();
}


//Mark site as adult, which will hide content for that site
function flag_adult(a) {
    $.post(
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
    $.post(
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
})( jQuery, window , document );

SyntaxHighlighter.all();




/*

 Blankwin function
 written by Alen Grakalic, provided by Css Globe (cssglobe.com)
 please visit http://cssglobe.com/post/1281/open-external-links-in-new-window-automatically/ for more info

 */

this.blankwin = function(){
    var hostname = window.location.hostname;
    hostname = hostname.replace("www.","").toLowerCase();
    var a = document.getElementsByTagName("a");
    this.check = function(obj){
        var href = obj.href.toLowerCase();
        return (href.indexOf("http://")!=-1 && href.indexOf(hostname)==-1) ? true : false;
    };
    this.set = function(obj){
        obj.target = "_blank";
        obj.className = "external";
    };
    for (var i=0;i<a.length;i++){
        if(check(a[i])) set(a[i]);
    };
};



// script initiates on page load.

this.addEvent = function(obj,type,fn){
    if(obj.attachEvent){
        obj['e'+type+fn] = fn;
        obj[type+fn] = function(){obj['e'+type+fn](window.event );}
        obj.attachEvent('on'+type, obj[type+fn]);
    } else {
        obj.addEventListener(type,fn,false);
    };
};
addEvent(window,"load",blankwin);
