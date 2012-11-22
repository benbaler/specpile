head.js('/assets/javascripts/libs/jquery.js',
    // '/assets/javascripts/libs/foundation.min.js', 
    '/assets/javascripts/libs/underscore.js', 
    '/assets/javascripts/libs/backbone.js', 
    '/assets/javascripts/libs/backbone-validation.js',
    '/assets/javascripts/models/searchEngine_m.js', 
    '/assets/javascripts/views/search_v.js', 
    '/assets/javascripts/models/product_m.js', 
    '/assets/javascripts/collections/products_c.js', 
    '/assets/javascripts/views/results_v.js', 
    '/assets/javascripts/views/product_v.js', 
    function() {
        // $("#customDropdown").foundationCustomForms();

        //Backbone.Model.prototype.idAttribute = "_id";

        var search = new Search({
            model: new SearchEngine()
        });

        // window.results = new Results({
        //     collection: new Products()
        // });


    });