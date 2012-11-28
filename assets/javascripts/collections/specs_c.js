var Specs = Backbone.Collection.extend({
	url: function(){
		return 'api/specs';
	},

	model: Spec
});