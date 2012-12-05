var SearchEngine = Backbone.Model.extend({
    url: '/search/product',

    defaults: {
        'term': null
    },

    validation: {
        term: {
            required: true,
            rangeLength: [1, 100]
        }
    }
});