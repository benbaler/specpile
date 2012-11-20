var Product = Backbone.View.extend({
	tagName: 'div',
	className: 'product-div',
	template: _.template($('#product-template').html()),

	events: {
		'click' : 'logClick'
	},

	initialize: function(){
		_.bindAll(this, 'logClick');
	},

	render: function(){
		this.$el.html(this.template(this.model.toJSON()));
        return this;
	},

	logClick: function(event){
		console.log(this.model.cid);
	}
});