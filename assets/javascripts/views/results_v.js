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
        var self = this;
        //this.$el.html("Searching for '" + query + "'");
        this.$el.html("");

        this.collection.reset();
        this.collection.query = query;

        this.collection.fetch({
            add: true,
            abortPending: true,
            success: function(collection, response, options) {
                if(collection.length == 0) {
                    self.$el.html("No Results for '" + query + "'");
                }
            },
            error: function(collection, response, options){
                self.$el.html("Error from Server, Try Again");
            }
            // ,query: query
            // ,url: this.collection.url+query
        });

    }
});