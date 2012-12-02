var Option = Backbone.Model.extend({
	url: function() {
		if(this._id !== null) {
			return '/api/option/id/' + this._id + '/action/product';
		} else {
			return '/api/option/action/product/';
		}
	},

	defaults: {
		_id: null,
		name: null,
		selected: null,
		product_id: null
	},

	idAttribute: '_id',

	parse: function(response) {
		response._id = response._id['$id'];
		return response;
	},

	initialize: function(options) {
		this._id = options._id;
		this.product_id = options.product_id;
	}
});