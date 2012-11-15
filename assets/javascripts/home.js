head.js('/assets/javascripts/libs/jquery.js','/assets/javascripts/libs/foundation.min.js', '/assets/javascripts/libs/underscore.js', '/assets/javascripts/libs/backbone.js', '/assets/javascripts/libs/backbone-validation.js',
    '/assets/javascripts/models/searchEngine_m.js', '/assets/javascripts/views/search_v.js', '/assets/javascripts/models/product_m.js', '/assets/javascripts/collections/products_c.js', '/assets/javascripts/views/results_v.js', function() {
        $("#customDropdown").foundationCustomForms();

        var searchEngine = new SearchEngine({});

        var search = new Search({
            model: searchEngine
        });

        var product = new Product({});  
        var product2 = new Product({id:"2"});  
        var prod = [product.toJSON(),product2.toJSON()];

        console.log("-----",prod,"-----");

        var products = new Products(prod);
        console.log(products.models);

        var results = new Results({
            collection: products
        });
    });