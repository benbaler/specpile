var Results = Backbone.View.extend({
    el: $('#results-panel'),

    initialize: function() {
        var self = this;

        this.collection.on("add", function(model) {
            var productView = new Product({
                model: model
            });
            self.$el.append(productView.render().$el);
        }, this);
    },

    render: function(query) {
        this.$el.html("Searching for '" + query + "'");

        this.collection.reset();
        this.collection.query = query;

        this.collection.fetch({
            add: true,
            success: function(collection, response, options) {
                console.log(collection, response, options);
                // if(this.collection.models.length == 0) {
                //     this.$el.html("No Results for '" + query + "'")
                // }
            }
            // ,query: query
            // ,url: this.collection.url+query
        });

    }
});