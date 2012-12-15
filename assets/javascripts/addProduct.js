head.js('/assets/javascripts/libs/jquery.js',
    '/assets/javascripts/libs/jquery.ui.js', 
    '/assets/javascripts/libs/jquery.foundation.topbar.js',
    '/assets/javascripts/libs/modernizr.foundation.js',
    // '/assets/javascripts/libs/foundation.min.js', 
    '/assets/javascripts/libs/underscore.js', 
    '/assets/javascripts/libs/backbone.js',
    '/assets/javascripts/libs/backbone-validation.js',
    '/assets/javascripts/views/addProduct_v.js',
    '/assets/javascripts/models/addProductCredentials_m.js',

    function() {
        $(document).ready(function(){
            $(document).foundationTopBar();
            $('#uvTab').addClass('hide-for-medium-down');
        _.extend(Backbone.Validation.messages, {
            length: 'Select {0}'
        });

        var addProductCredentials = new AddProductCredentials({});
        var addProduct = new AddProductView({
            model: addProductCredentials
        });
        });
    });