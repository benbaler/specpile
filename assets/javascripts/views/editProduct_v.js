var EditProductView = Backbone.View.extend({
	el: $('#editProduct-form'),
	template: _.template($('#specs-template').html()),

	events: {

	},

	initialize: function(){
		this.render();
	},

	render: function(){
		this.$el.append(this.template(this.model.toJSON()));
	}
});