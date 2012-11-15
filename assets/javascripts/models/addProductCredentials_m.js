var AddProductCredentials = Backbone.Model.extend({
    url: '/index.php/product/add',

    defaults: {
        'category': '',
        'brand': '',
        'model': ''
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