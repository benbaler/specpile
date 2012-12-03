var Spec = Backbone.Model.extend({
	url: function() {
		if(this._id !== null) {
			return '/api/spec/id/' + this._id;
		} else {
			return '/api/spec';
		}
	},

	defaults: {
		_id: null,
		category_id: null,
		product_id: null,
		name: null
	},

	options: null,

	idAttribute: '_id',

	parse: function(response) {
		response._id = response._id['$id'];
		return response;
	},

	initialize: function(options) {
		if(options !== undefined) {
			this._id = options._id;
			this.options = new Options(options.options);
		}
	}
});