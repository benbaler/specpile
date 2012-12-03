var EditSpecView = Backbone.View.extend({
	tagName: "div",

	template: _.template($('#spec-template').html()),

	events: {
		'keyup .spec': 'showSaveButton',
		'keyup .field': 'showSaveButton',
		// 'keydown .spec': 'showSaveButton',
		// 'change .spec': 'showSaveButton',
		// 'blur .spec': 'showSaveButton',
		// 'focus .spec': 'showSaveButton',
		// 'click .spec': 'showSaveButton',
		'click button': 'saveSpecAndOption'
	},

	initialize: function() {
		//_.bindAll(this, 'specOver', 'specOut');
	},

	render: function() {
		this.$el.html(this.template(this.model.toJSON()));
		return this;
	},

	autoComplete: function() {
		var id = this.model.get('_id');
		var options = this.getOptionsList();
		var self = this;

		$('.spec[data-id="' + id + '"]').autocomplete({
			source: options,
			minLength: 0,
			select: function() {
				//$(this).trigger('keyup');
			}
		}).focus(function() {
			$(this).data("autocomplete").search($(this).val());
		});
	},

	getOptionsList: function() {
		var options = [];
		_.each(this.model.options.models, function(option, i) {
			options.push(option.get('name'));
		}, this);

		return options;
	},

	showSaveButton: function(event) {
		var button = $('button', this.$el);
		var value = $('.spec', this.$el).val();
		var field = $('.field', this.$el).val();
		var option = this.getSelectedOption();

		if(option !== undefined) {
			if($.trim(value).toLowerCase() == option.get('name').toLowerCase() && $.trim(field).toLowerCase() == this.model.get('name').toLowerCase()) {
				button.addClass('hide');
			} else {
				button.removeClass('hide');
			}
		} else {
			if(value && field) {
				button.removeClass('hide');
			} else {
				button.addClass('hide');
			}
		}
	},

	getSelectedOption: function() {
		var options = this.model.options.where({
			selected: true
		});

		return options[0];
	},

	setSelectedOption: function(id) {
		_.each(this.model.options.models, function(model){
			if(model.get('_id') == id){
				model.set('selected', true);
			} else{
				model.set('selected', false);
			}
		}, this);
	},

	saveSpecAndOption: function(event) {
		var option = $('.spec', this.$el).val();
		var spec = $('.field', this.$el).val();

		// TODO: must add spec before add option because need id
		

		// save spec


		// option save
		console.log(this.getOptionsList());
		var match = _.find(this.getOptionsList(), function(val) {
			return val.toLowerCase() == $.trim(option).toLowerCase();
		});

		if(match) {
			console.log('exists');
			var options = this.model.options.where({
				name: match
			});

			console.log(options[0].toJSON());
			var self = this;
			options[0].save({}, {
				success: function(model, response) {
					console.log(response);
					data = JSON.parse(response.responseText);
					self.setSelectedOption(data._id);
				},
				error: function(model, response) {
					data = JSON.parse(response.responseText);
					$(self.el).prev('.alert').remove();
					$(self.el).before('<div class="row alert-box alert"> Error: ' + data.error.message + '<a href="#" onclick="$(this).parent().remove()" class="close">&times;</a></div>');
				}
			});
		} else {
			console.log('new');
			var o = new Option({
				name: option, 
				selected: false, 
				product_id: this.model.get('product_id'),
				spec_id: this.model.get('_id')
			});	

			this.model.options.add(o.toJSON());
			var self = this;
			o.save({}, {
				success: function(model, response) {
					console.log(response.responseText);
				},
				error: function(model, response) {
					data = JSON.parse(response.responseText);
					$(self.el).prev('.alert').remove();
					$(self.el).before('<div class="row alert-box alert"> Error: ' + data.error.message + '<a href="#" onclick="$(this).parent().remove()" class="close">&times;</a></div>');
				}
			});
		}

		return;

		// save exist option
		if(options.length && field == this.model.get('name')) {
			console.log('exists');
			this.model.save();
			options[0].save();
		}
		// save new option
		else {
			this.model.set({
				name: field
			});
			this.model.save({}, {
				success: function(model, response) {
					console.log(JSON.parse(response.responseText));
				},
				error: function(model, response) {
					data = JSON.parse(response.responseText);
					$(self.el).prev('.alert').remove();
					$(self.el).before('<div class="row alert-box alert"> Error: ' + data.error.message + '<a href="#" onclick="$(this).parent().remove()" class="close">&times;</a></div>');
				}
			});
			//options[0].save();
		}
	}
});