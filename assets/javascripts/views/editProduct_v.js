var EditProductView = Backbone.View.extend({
	el: $('#editProduct-form'),

	events: {

	},

	initialize: function() {
		this.render();
	},

	render: function() {
		// var product = this.model.toJSON();
		// this.$el.append(this.template(product));
		// _.each(product.specs, function(i, k) {
		// 	$("#spec_" + k).autocomplete({
		// 		source: i.options,
		// 		minLength: 0,
		// 		open: function(event, ui) {
		//           		//$(".ui-autocomplete").sortable();
		//           		//$(".ui-autocomplete").disableSelection();
		//       		}
		// 	}).focus(function() {
		// 		//Use the below line instead of triggering keydown
		// 		$(this).data("autocomplete").search($(this).val());
		// 	});
		// });
		// 
		// 
		// _.each(this.model.get('specs'), function(spec,i){
		// 	var spec = new Spec(spec);
		// 	var editSpecView = new EditSpecView({model: spec});
		// 	console.log(spec.toJSON());
		// });
		//this.model.collection = new Specs(this.model.get('specs'));
		//this.collection = new Specs(this.model.get('specs'));
		var self = this;
		_.each(this.model.specs.models, function(spec, i) {
			var editSpecView = new EditSpecView({
				model: spec
			});

			self.$el.append(editSpecView.render().$el);
			editSpecView.autoComplete();
			// editSpecView.delegateEvents();
		}, this);
	}
});