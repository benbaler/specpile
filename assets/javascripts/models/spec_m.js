var Spec = Backbone.Model.extend({
	url: function(){
		return 'api/spec/id' + this._id;
	},

	defaults: {
		_id: null,
		name: null
	},

	options: null,

	initialize: function(options){
		this._id = options._id;
		this.options = new Options(options.options);
	}
});