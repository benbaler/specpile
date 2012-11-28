var Products = Backbone.Collection.extend({
	url: function(){
		return 'api/search/query/' + this.query;
	},
	query: null,
	model: Product
});