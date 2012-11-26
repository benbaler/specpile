var AddProductCredentials = Backbone.Model.extend({
    url: '/index.php/api/product',

    defaults: {
        'category': null,
        'brand': null,
        'product': null
    },

    validation: {
        category: {
            required: true,
            rangeLength: [1, 50]
        },
        brand: {
            required: true,
            rangeLength: [1, 50]
        },
        product: {
            required: true,
            rangeLength: [1, 50]
        },
    }
});