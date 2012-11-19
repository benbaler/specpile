var Results = Backbone.View.extend({
    el: $('#results-panel'),
    template: _.template($('#results-template').html()),

    initialize: function() {
    },

    render: function(query) {
        var self = this;

        this.collection.fetch({
            add: true,
            url: this.collection.url+query
        });

        this.$el.html('');
        
        this.collection.on("add", function(model) {
            self.$el.append(self.template(model.toJSON()));
        });
    }
});