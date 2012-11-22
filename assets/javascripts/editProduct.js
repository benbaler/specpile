head.js(
    '/assets/javascripts/libs/jquery.js', 
    '/assets/javascripts/libs/jquery.ui.js', 
    // '/assets/javascripts/libs/foundation.min.js', 
    '/assets/javascripts/libs/underscore.js', 
    '/assets/javascripts/libs/backbone.js',
    '/assets/javascripts/libs/backbone-validation.js',
    '/assets/javascripts/views/editProduct_v.js',
    '/assets/javascripts/models/editProductCredentials_m.js',

    function() {
        //$("#sortable").sortable();
        //$("#sortable").disableSelection();

        var editProductCredentials = new EditProductCredentials(window.productData);

        var editProductView = new EditProductView({
            model: editProductCredentials
        });
   });