var SearchEngine = Backbone.Model.extend({
    url: '/index.php/search/product',

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