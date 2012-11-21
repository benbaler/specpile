head.js('/assets/javascripts/libs/jquery.js',
    '/assets/javascripts/libs/foundation.min.js', 
    '/assets/javascripts/libs/underscore.js', 
    '/assets/javascripts/libs/backbone.js',
    '/assets/javascripts/libs/backbone-validation.js',
    '/assets/javascripts/views/addProduct_v.js',
    '/assets/javascripts/models/addProductCredentials_m.js',

    function() {
        _.extend(Backbone.Validation.messages, {
            length: 'Select {0}'
        });

        var addProductCredentials = new AddProductCredentials({});
        var addProduct = new AddProductView({
            model: addProductCredentials
        });
    });