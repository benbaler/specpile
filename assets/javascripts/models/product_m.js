var Product = Backbone.Model.extend({
	url: function(){
		return '/api/search/product/' + this.id
	},

	defaults: {
		_id: null,
		name: null,
		category_id: null,
		category_name: null,
		brand_id: null,
		brand_name: null,
		image: null
	},

	specs: null,

	idAttribute: '_id',

	initialize: function(options){
		if(options.specs !== undefined)
			this.specs = new Specs(options.specs);
	}
});