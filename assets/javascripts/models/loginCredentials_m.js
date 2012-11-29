var LoginCredentials = Backbone.Model.extend({
    url: '/api/user',

    defaults: {
        '_id': null,
        'email': null,
        'pass': null
    },

    idAttribute: '_id',

    parse: function(response) {
        response._id = response._id['$id'];
        return response;
    },

    validation: {
        email: {
            required: true,
            pattern: 'email'
        },
        pass: {
            required: true,
            rangeLength: [4, 12]
        }
    }
});