var Products = Backbone.Collection.extend({
	url: function(){
		return '/index.php/api/search/query/' + this.query;
	},
	query: null,
	model: Product
});