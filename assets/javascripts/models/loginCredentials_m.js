var LoginCredentials = Backbone.Model.extend({
    url: '/user/login',

    defaults: {
        'email': '',
        'pass': ''
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