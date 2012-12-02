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

        this.resultsView = new Results({
            collection: new Products()
        });

        this.render(window.categories);
    },

    render: function(categories){
        $("#categories").autocomplete({
            source: categories,
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

    getPreviewProducts: function(event) {
        event.preventDefault();

        this.displayError(this.getInputByName('query'));
        this.model.set('query', this.getInputByName('query').val());


        if(this.model.isValid()) {
            //alert(this.model.get('query'));
            this.resultsView.render(this.model.get('query'));
        } else {
            //alert(this.displayError(this.getInputByName('query')));
            this.resultsView.render(this.model.get('query'));
        }

    },

    previewProducts: function(event) {
        element = $(event.target);
        error = this.model.preValidate(element.attr('name'), element.val());

        if(error) {
            this.displayError(element);
        } else {
            this.autoComplete(this.getInputByName('query').val());
        }
    },

    getInputByName: function(name) {
        return $('input[name="' + name + '"]', this.el);
    },

    autoComplete: function(value) {
        //console.log(value);
        this.resultsView.render(value);
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