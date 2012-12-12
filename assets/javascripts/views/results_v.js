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
        //this.$el.html("Searching for '<b>" + query + "</b>'<br/><br/>");
        this.$el.html("");

        this.collection.reset();
        this.collection.query = query;

        this.collection.fetch({
            add: true,
            abortPending: true,
            success: function(collection, response, options) {
                if(collection.length == 0) {
                    self.$el.html("<li>No Results for '" + query + "'</li>");
                }
            },
            error: function(collection, response, options){
                self.$el.html("<li>Error from Server, Try Again</li>");
            }
            // ,query: query
            // ,url: this.collection.url+query
        });

    }
});