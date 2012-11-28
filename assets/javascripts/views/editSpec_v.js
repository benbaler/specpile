var EditSpecView = Backbone.View.extend({
	tagName: "div",

	template: _.template($('#spec-template').html()),

	events: {
		'keyup .spec': 'showSaveButton',
		'click button': 'saveOption'
	},

	initialize: function() {
		//_.bindAll(this, 'specOver', 'specOut');
	},

	render: function() {
		this.$el.html(this.template(this.model.toJSON()));
		return this;
	},

	autoComplete: function(){
		var id = this.model.get('_id');
		var options = this.getOptionsList();

		$('.spec[data-id="'+id+'"]').autocomplete({
			source: options,
			minLength: 0
		}).focus(function() {
			$(this).data("autocomplete").search($(this).val());
		});
	},

	getOptionsList: function(){
		var options = [];
		_.each(this.model.options.models, function(option, i){
			options.push(option.get('name'));
		}, this);

		console.log(options);
		return options;
	},

	showSaveButton: function(event){
		var element = $(event.target);
		var button = $('button', this.$el);
		var value = element.val();
		var option = this.getSelectedOption();
		
		if(value == option.get('name')){
			button.addClass('hide');
		} else{
			button.removeClass('hide');
		}
	},

	getSelectedOption: function(){
		var options = this.model.options.where({selected: true});
		return options[0];
	},

	saveOption: function(event){
		var value = $('.spec', this.$el).val();
		var options = this.model.options.where({name: value});
		
		// save exist option
		if(options.length){
			options[0].save();
		} 
		// save new option
		else{

		}
	}
});