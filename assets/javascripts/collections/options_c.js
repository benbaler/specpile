var Options = Backbone.Collection.extend({
	url: function(){
		return 'api/options';
	},

	model: Option
});