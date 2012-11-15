var Products = Backbone.Collection.extend({
	url: '/index.php/search',
	model: Product
});