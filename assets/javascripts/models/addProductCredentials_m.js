var AddProductCredentials = Backbone.Model.extend({
    url: '/index.php/api/product',

    defaults: {
        'category': null,
        'brand': null,
        'model': null
    },

    validation: {
        category: {
            required: true,
            length: 24
        },
        brand: {
            required: true,
            length: 24
        },
        model: {
            required: true,
            rangeLength: [1, 50]
        },
    }
});