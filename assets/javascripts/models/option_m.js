var Option = Backbone.Model.extend({
	url: function(){
		return 'api/option/id/' + this._id + '/product_id/' + this.product_id;
	},

	defaults: {
		_id: null,
		name: null,
		selected: null,
		product_id: null
	},

	initialize: function(options){
		this._id = options._id;
		this.product_id = options.product_id;
	}
});