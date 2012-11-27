var SearchEngine = Backbone.Model.extend({
    url: '/search/product',

    defaults: {
        'term': ''
    },

    validation: {
        term: {
            required: true,
            rangeLength: [1, 100]
        }
    }
});