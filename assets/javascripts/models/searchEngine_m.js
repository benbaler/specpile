var SearchEngine = Backbone.Model.extend({
    url: '/search/product',

    defaults: {
        'term': null,
        'category': null
    },

    validation: {
        term: {
            required: true,
            rangeLength: [1, 100]
        },
        category: {
            rangeLength: [0, 100]
        }
    }
});