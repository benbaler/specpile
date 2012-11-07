head.ready(function() {

    var currentPage = function(str) {
            var path = document.location.pathname;
            if(path.search(str) >= 0) return true;
            if(str == 'home' && path == '/') return true;
            return false;
        }   

        // LOGIN
    if(currentPage('login')) {
        head.js('/assets/javascripts/models/loginCredentials_m.js', '/assets/javascripts/views/login_v.js', function() {
            var loginCredentials = new LoginCredentials({});

            var login = new Login({
                model: loginCredentials
            });
        });
    }

    // REGISTER
    if(currentPage('register')) {
        head.js('/assets/javascripts/models/registerCredentials_m.js', '/assets/javascripts/views/register_v.js', function() {
            var registerCredentials = new RegisterCredentials({});

            var register = new Register({
                model: registerCredentials
            });
        });
    }

    // HOME
    if(currentPage('home')) {
        head.js('/assets/javascripts/models/searchEngine_m.js', '/assets/javascripts/views/search_v.js', '/assets/javascripts/models/product_m.js', '/assets/javascripts/collections/products_c.js', '/assets/javascripts/views/results_v.js', function() {
            var searchEngine = new SearchEngine({});

            var search = new Search({
                model: searchEngine
            });

            var product = new Product({});

            var products = new Products(product);

            var results = new Results({
                collection: products
            });
        });
    }



    // var ProductModel = Backbone.Model.extend({
    //     defaults: {
    //         name: '16GB Black'
    //     }
    // });
    // var productModel = new ProductModel({});
    // var ProductModels = Backbone.Collection.extend({
    //     model: ProductModel
    // });
    // var productModels = new ProductModels(productModel);
    // var products = new Products([JSON.stringify(product).replace(/\"([^(\")"]+)\":/g,"$1:"), JSON.stringify(product).replace(/\"([^(\")"]+)\":/g,"$1:"), JSON.stringify(product).replace(/\"([^(\")"]+)\":/g,"$1:")]);
    //p = "'"+JSON.stringify(product).replace(/\"([^(\")"]+)\":/g, "$1:")+"'";
    //console.log(p);
    // console.log(JSON.parse(JSON.stringify(product)));
    // console.log(String(JSON.stringify(product).replace(/\"([^(\")"]+)\":/g,"$1:")));
    /*
    
    var ProductModels = new Backbone.Collection.extend({});

    var productModels = new ProductModels({
        model: productModel
    });

    var Product = new Backbone.Model.extend({
        defaults: {
            name: 'iPhone 4S'
        }
    });

    var product = new Product({
        collection: productModels
    });

    var Products = new Backbone.Collection.extend({});

    var products = new Products({
        model: product
    });


    var Results = Backbone.View.extend({
        el: $('#results-panel'),

        template: 'Name: <%= name %>',

        initialize: function() {
            $(this.el).html(this.template({
                name: "Ben"
            }));
        }
    });

    var results = new Results({
        collection: products
    });

*/



});