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