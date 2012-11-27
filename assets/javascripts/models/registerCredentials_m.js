 var RegisterCredentials = Backbone.Model.extend({
     url: '/user/register',

     defaults: {
         'first': '',
         'last': '',
         'email': '',
         'pass': ''
     },

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