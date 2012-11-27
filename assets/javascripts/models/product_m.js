var Product = Backbone.Model.extend({
	url: function(){
		return '/api/search/product/' + this.id
	},

	defaults: {
		_id: null,
		name: null,
		category_id: null,
		brand_id: null
	},

	idAttribute: '_id',

	parse: function(response) {
		response._id = response._id['$id'];
		return response;
	}
});