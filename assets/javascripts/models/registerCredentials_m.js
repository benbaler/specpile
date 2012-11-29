 var RegisterCredentials = Backbone.Model.extend({
     url: '/api/user/signup',

     defaults: {
        '_id' : null,
         'first': null,
         'last': null,
         'email': null,
         'pass': null
     },

     idAttribute: '_id',

     validation: {
         first: {
             required: true,
             rangeLength: [2, 20]
         },
         last: {
             required: true,
             rangeLength: [2, 20]
         },
         email: {
             required: true,
             pattern: 'email',
             fn: function(value, attr, computedState) {
                 // check if email already exists
             }
         },
         pass: {
             required: true,
             rangeLength: [4, 12]
         }
     }
 });