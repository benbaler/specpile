var EditProductView = Backbone.View.extend({
	el: $('#editProduct-form'),
	template: _.template($('#specs-template').html()),

	events: {

	},

	initialize: function() {
		this.render();
	},

	render: function() {
		var product = this.model.toJSON();
		this.$el.append(this.template(product));
		_.each(product.specs, function(i, k) {
			$("#spec_" + k).autocomplete({
				source: i.options,
				minLength: 0,
				open: function(event, ui) {
            		//$(".ui-autocomplete").sortable();
            		//$(".ui-autocomplete").disableSelection();
        		}
			}).focus(function() {
				//Use the below line instead of triggering keydown
				$(this).data("autocomplete").search($(this).val());
			});
		});
	}
});