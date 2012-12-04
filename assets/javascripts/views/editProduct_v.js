var EditProductView = Backbone.View.extend({
	el: $('#editProduct-form'),

	events: {
		'click #addNewSpecField button': 'addNewSpecField'
	},

	initialize: function() {
		_.bindAll(this, 'addNewSpecField');
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

		this.$el.append('<div class="row" id="addNewSpecField">'
		  				+'<div class="six mobile-four columns offset-by-one">'
		    			+'<button id="addNewSpecField" class="button expand">Add New Field</button>'
		  				+'</div>'
						+'</div>');
	},

	addNewSpecField: function(event) {
		var editSpecView = new EditSpecView({
			model: new Spec({
				category_id: this.model.get('category_id'),
				product_id: this.model.get('_id'),
				name: '',
				options: []
			})
		});

		$(editSpecView.render().$el).insertBefore('#addNewSpecField', this.$el);
		// this.$el.append(editSpecView.render().$el);
		editSpecView.autoComplete();
	}
});