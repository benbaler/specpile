var AddProductView = Backbone.View.extend({
    el: $('#addProduct-form'),

    events: {
        'submit': 'submitCredentials',
        'keyup input': 'validateField',
        'change select': 'validateField'
    },

    initialize: function() {
        _.bindAll(this, 'submitCredentials', 'validateField');
        Backbone.Validation.bind(this, {
            selector: 'name',
            forceUpdate: true
        });

        $("#categories").autocomplete({
            source: window.categories,
            minLength: 0,
            open: function(event, ui) {
                //$(".ui-autocomplete").sortable();
                //$(".ui-autocomplete").disableSelection();
            }
        }).focus(function() {
            //Use the below line instead of triggering keydown
            $(this).data("autocomplete").search($(this).val());
        });

        $("#brands").autocomplete({
            source: window.brands,
            minLength: 0,
            open: function(event, ui) {
                //$(".ui-autocomplete").sortable();
                //$(".ui-autocomplete").disableSelection();
            }
        }).focus(function() {
            //Use the below line instead of triggering keydown
            $(this).data("autocomplete").search($(this).val());
        });
    },

    validateField: function(event) {
        this.displayError($(event.target));
    },

    displayError: function(element) {
        next = String(element.next().prop("tagName")).toLowerCase() == "small" ? element.next() : element.after('<small class="hide"></small>').next();

        switch(element.prop("tagName")) {
        case "SELECT":
            val = $('option:selected', element).val();
            break;
        case "INPUT":
            val = element.val();
            break;
        }

        error = this.model.preValidate(element.attr('name'), val);

        if(error) {
            element.addClass('error');
            next.removeClass('hide').addClass('error').html(error);
        } else {
            element.removeClass('error');
            next.removeClass('error').addClass('hide');
        }
    },

    getInputByName: function(name) {
        return $('[name="' + name + '"]', this.el);
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
                    location.href = 'edit/' + response.id;
                },
                error: function(model, response) {
                    data = JSON.parse(response.responseText);
                    $(self.el).prev('.alert').remove();
                    $(self.el).before('<div class="row alert-box alert"> Error: ' + data.error.message + '<a href="#" onclick="$(this).parent().remove()" class="close">&times;</a></div>');
                }
            });
        }
        return false;
    }
});