var LoginCredentials = Backbone.Model.extend({
    url: '/index.php/user/login',

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