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
                    location.href = "/";
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