var Results = Backbone.View.extend({
    el: $('#results-panel'),

    template: _.template($('#results-template').html()),

    initialize: function() {
        self = this;
        this.collection.fetch();
        _.each(this.collection.models, function(product) {
            console.log(product.toJSON());
            $(self.el).html(self.template(product.toJSON()));
        });
    }
});