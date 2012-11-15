var Results = Backbone.View.extend({
    el: $('#results-panel'),

    template: _.template($('#results-template').html()),

    initialize: function() {
        // self = this;

        //this.collection.fetch();
        // console.log(this.collection.models);
        // console.log(this.collection);
        _.each(this.collection.models, _.bind(function(product) {
            // console.log(product.toJSON()); 
            this.$el.append(this.template(product.toJSON()));
        }, this));
    }
});