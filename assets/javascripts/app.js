 $(function() {

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

     var Search = Backbone.View.extend({
         el: $('#search-form'),

         events: {
             'keyup input': 'previewProducts',
             'submit': 'getPreviewProducts'
         },

         initialize: function() {
             _.bindAll(this, 'previewProducts', 'getPreviewProducts');
             Backbone.Validation.bind(this, {
                 selector: 'name',
                 forceUpdate: true
             });
         },

         getPreviewProducts: function(event) {
             event.preventDefault();

             this.displayError(this.getInputByName('term'));
             this.model.set('term', this.getInputByName('term').val());


             if(this.model.isValid()) {
                 alert(this.model.get('term'));
             } else {
                 alert(this.displayError(this.getInputByName('term')));
             }

         },

         previewProducts: function(event) {
             element = $(event.target);
             error = this.model.preValidate(element.attr('name'), element.val());

             if(error) {
                 this.displayError(element);
             } else {
                 this.autoComplete(this.getInputByName('term').val());
             }
         },

         getInputByName: function(name) {
             return $('input[name="' + name + '"]', this.el);
         },

         autoComplete: function(value) {
             console.log(value);
         },

         displayError: function(element, error) {
             next = new String(element.next().prop("tagName")).toLowerCase() == "small" ? element.next() : element.after('<small class="hide"></small>').next();

             error = this.model.preValidate(element.attr('name'), element.val());

             if(error) {
                 element.addClass('error');
                 next.removeClass('hide').addClass('error').html(error);
             } else {
                 element.removeClass('error');
                 next.removeClass('error').addClass('hide');
             }
         }
     });



     var SearchResults = Backbone.Model.extend({
        url: "/index.php/search"
     });

     var SearchPreviewList = Backbone.Collection.extend({
        
     });


     var Results = Backbone.View.extend({
         el: $('#results-template')
     });



     var searchEngine = new SearchEngine({});

     var search = new Search({
         model: searchEngine
     });



     var searchPreview = new SearchPreview({});

     var searchPreviewList = new SearchPreviewList({
         model: searchPreview
     });

     var preview = new Preview({
         collection: searchPreviewList
     });



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

     var RegisterCredentials = Backbone.Model.extend({
         url: '/index.php/user/register',

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

     var Register = Backbone.View.extend({
         el: $('#register-form'),

         events: {
             'submit': 'submitCredentials',
             'keyup input': 'validateField'
         },

         initialize: function() {
             _.bindAll(this, 'submitCredentials', 'validateField');
             Backbone.Validation.bind(this, {
                 selector: 'name',
                 forceUpdate: true
             });
         },

         validateField: function(event) {
             this.displayError($(event.target));
         },

         displayError: function(element, error) {
             next = new String(element.next().prop("tagName")).toLowerCase() == "small" ? element.next() : element.after('<small class="hide"></small>').next();

             error = this.model.preValidate(element.attr('name'), element.val());

             if(error) {
                 element.addClass('error');
                 next.removeClass('hide').addClass('error').html(error);
             } else {
                 element.removeClass('error');
                 next.removeClass('error').addClass('hide');
             }
         },

         getInputByName: function(name) {
             return $('input[name="' + name + '"]', this.el);
         },

         submitCredentials: function(event) {
             event.preventDefault();

             self = this;

             $.each(this.model.defaults, function(key, value) {
                 self.displayError(self.getInputByName(key));
                 self.model.set(key, self.getInputByName(key).val());
             });


             if(this.model.isValid()) {
                 this.model.save({}, {
                     success: function(model, response) {
                         location.reload();
                     },
                     error: function(model, response) {
                         data = JSON.parse(response.responseText);
                         $(self.el).prev('.alert').remove();
                         $(self.el).before('<div class="alert-box alert"> Error: ' + data.error.message + '<a href="#" class="close">&times;</a></div>');
                     }
                 });
             }
         }
     });


     var Login = Backbone.View.extend({
         el: $('#login-form'),

         events: {
             'submit': 'submitCredentials',
             'keyup input': 'validateField'
         },

         initialize: function() {
             _.bindAll(this, 'submitCredentials', 'validateField');
             Backbone.Validation.bind(this, {
                 selector: 'name',
                 forceUpdate: true
             });
         },

         validateField: function(event) {
             this.displayError($(event.target));
         },

         displayError: function(element, error) {
             next = new String(element.next().prop("tagName")).toLowerCase() == "small" ? element.next() : element.after('<small class="hide"></small>').next();

             error = this.model.preValidate(element.attr('name'), element.val());

             if(error) {
                 element.addClass('error');
                 next.removeClass('hide').addClass('error').html(error);
             } else {
                 element.removeClass('error');
                 next.removeClass('error').addClass('hide');
             }
         },

         getInputByName: function(name) {
             return $('input[name="' + name + '"]', this.el);
         },

         submitCredentials: function(event) {
             event.preventDefault();

             self = this;

             $.each(this.model.defaults, function(key, value) {
                 self.displayError(self.getInputByName(key));
                 self.model.set(key, self.getInputByName(key).val());
             });


             if(this.model.isValid()) {
                 this.model.save({}, {
                     success: function(model, response) {
                         location.reload();
                     },
                     error: function(model, response) {
                         data = JSON.parse(response.responseText);
                         $(self.el).prev('.alert').remove();
                         $(self.el).before('<div class="alert-box alert"> Error: ' + data.error.message + '<a href="#" class="close">&times;</a></div>');
                     }
                 });
             }
         }
     });

     var loginCredentials = new LoginCredentials({});

     var login = new Login({
         model: loginCredentials
     });

     var registerCredentials = new RegisterCredentials({});

     var register = new Register({
         model: registerCredentials
     });

 });