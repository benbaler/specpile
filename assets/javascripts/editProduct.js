head.js(
    '/assets/javascripts/libs/jquery.js', 
    '/assets/javascripts/libs/jquery.ui.js', 
    // '/assets/javascripts/libs/foundation.min.js', 
    '/assets/javascripts/libs/underscore.js', 
    '/assets/javascripts/libs/backbone.js',
    '/assets/javascripts/libs/backbone-validation.js',

    '/assets/javascripts/views/editProduct_v.js',
    '/assets/javascripts/views/editSpec_v.js',

    '/assets/javascripts/models/option_m.js',
    '/assets/javascripts/collections/options_c.js',
    
    '/assets/javascripts/models/spec_m.js',
    '/assets/javascripts/collections/specs_c.js',
    
    '/assets/javascripts/models/product_m.js',


    //'/assets/javascripts/models/editProductCredentials_m.js',

    function() {
        $(document).ready(function(){
        //$("#sortable").sortable();
        //$("#sortable").disableSelection();

        //var editProductCredentials = new EditProductCredentials(window.productData);

        //console.log(window.productData);

        var product = new Product(window.productData);

        var editProductView = new EditProductView({
            model: product
        });
        });
   });