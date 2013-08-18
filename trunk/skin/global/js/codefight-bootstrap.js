;(function( $, window, document, undefined ){

    // Cfbootstrap constructor
    var Cfbootstrap = function( elem, options ){
        this.elem = elem;
        this.$elem = $(elem);
        this.options = options;

        // This next line takes advantage of HTML5 data attributes
        // to support customization of the cfbootstrap on a per-element
        // basis. For example,
        // <div class="item"  data-cfbootstrap-options='{"delete":"minus-sign"}'></div>
        this.metadata = this.$elem.data( 'cfbootstrap-options' );
    };

    // the cfbootstrap prototype
    Cfbootstrap.prototype = {
        defaults: {
            message: 'Hello Codefight Bootstrap!',
            delete: 'trash',
            edit: 'edit',
            create: 'plus-sign',
            reset: 'refresh'
        },

        init: function() {
            // Introduce defaults that can be extended either
            // globally or using an object literal.
            this.config = $.extend({}, this.defaults, this.options, this.metadata);

            // Sample usage:
            // Set the message per instance:
            // $('#elem').cfbootstrap({ message: 'Goodbye World!'});
            // or
            // var p = new Cfbootstrap(document.getElementById('elem'),
            // { message: 'Goodbye World!'}).init()
            // or, set the global default message:
            // Cfbootstrap.defaults.message = 'Goodbye World!'

            this.glyphIcons();
            return this;
        },

        glyphIcons: function() {
            // eg. show the currently configured message
            // console.log(this.config.message);
            var $input = this.$elem,
                $value = $input.attr('value'),
                $class = $input.attr('class'),
                $id= $input.attr('id'),
                $icon = this.config[$id];

            // If icon is defined for this id,
            // add icon on the input button
            // if no icon configured, do nothing
            if($icon){
                var $button = $('<button class="'+$class+'"><i class="icon-'+$icon+' icon-white"></i>&nbsp;'+$value+'</button>');
                $button.insertBefore($input);
                $input.wrap('<span class="hide"/>');
                $button.click(function(){
                    $input.trigger('click');
                    return false;
                });
            }
        }
    }

    Cfbootstrap.defaults = Cfbootstrap.prototype.defaults;

    $.fn.cfbootstrap = function(options) {
        return this.each(function() {
            new Cfbootstrap(this, options).init();
        });
    };

    //optional: window.Cfbootstrap = Cfbootstrap;
    $(document).ready(function(){
        $('input.btn').cfbootstrap();
    });

})( jQuery, window , document );