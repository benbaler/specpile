var Products = Backbone.Collection.extend({
	url: '/index.php/api/search/query/',
	model: Product
});