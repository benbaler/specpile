var Search = Backbone.View.extend({
    el: $('#search-form'),

    events: {
        'keyup input': 'getProductsNames',
        'submit': 'getProductsResults'
    },

    initialize: function() {
        _.bindAll(this, 'getProductsNames', 'getProductsResults');

        Backbone.Validation.bind(this, {
            selector: 'name',
            forceUpdate: true
        });

        this.resultsView = new Results({
            collection: new Products()
        });

        this.render();
    },

    render: function(){
        var self = this;
        $('#term', this.$el).autocomplete({
            source: [],
            minLength: 1
        });
    },

    getProductsResults: function(event) {
        event.preventDefault();

        this.displayError(this.getInputByName('term'));
        this.model.set('term', this.getInputByName('term').val());


        if(this.model.isValid()) {
            //alert(this.model.get('term'));
            this.resultsView.render(this.model.get('term'));
        } else {
            //alert(this.displayError(this.getInputByName('term')));
            //this.resultsView.render(this.model.get('term'));
        }
        return false;

    },

    getProductsNames: function(event) {
        element = $(event.target);
        error = this.model.preValidate(element.attr('name'), element.val());

        this.displayError(element);
        
        if(error) {
        } else {
            this.autoComplete(element.val());
            //this.autoComplete(this.getInputByName('term').val());
        }
    },

    getInputByName: function(name) {
        return $('input[name="' + name + '"]', this.el);
    },

    autoComplete: function(value) {
        $.get('api/products/term/'+value, function(data) {
            results = [];
            $.each(data, function(i,val){
                results.push(val);
            });
            console.log(results);
            $("#term", this.$el).autocomplete("option", "source", results);
        });
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