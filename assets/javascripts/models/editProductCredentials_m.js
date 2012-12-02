var EditProductCredentials = Backbone.Model.extend({
    url: '/api/product',

    defaults: {
        'id': null,
        'name': null,
        'category_id': null,
        'brand_id': null
    },

    specs: null,

    validation: {
        id: {
            required: true,
            length: 24
        },
        category_id: {
            required: true,
            length: 24
        },
        brand_id: {
            required: true,
            length: 24
        },
        name: {
            required: true,
            rangeLength: [1, 50]
        },
    }
});