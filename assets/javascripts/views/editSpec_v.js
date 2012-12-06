var EditSpecView = Backbone.View.extend({
	tagName: "div",
	className: "superSpec",

	template: _.template($('#spec-template').html()),

	events: {
		'keyup .spec': 'showSaveButton',
		'keyup .field': 'showSaveButton',
		// 'keydown .spec': 'showSaveButton',
		// 'change .spec': 'showSaveButton',
		// 'blur .spec': 'showSaveButton',
		// 'focus .spec': 'showSaveButton',
		// 'click .spec': 'showSaveButton',
		'click button': 'saveSpec'
	},

	initialize: function() {
		//_.bindAll(this, 'specOver', 'specOut');
	},

	render: function() {
		this.$el.html(this.template(this.model.toJSON()));
		return this;
	},

	autoComplete: function() {
		var self = this;

		$('.spec', this.$el).autocomplete({
			source: self.getOptionsList(),
			minLength: 0,
			select: function(a, b) {
				// a autocomplete object, b input object
				$(a.target).val(b.item.value);
				$('.spec', self.$el).trigger('keyup');
			}
		}).bind('focus click keyup', function(event) {
			if(event.which == 38 || event.which == 40) return;
			$(this).data("autocomplete").search(''); //$(this).val());
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

		// console.log(value, field,'----', option.toJSON(), this.model.toJSON());
		if(option !== undefined) {
			if($.trim(value).toLowerCase() == option.get('name').toLowerCase() && $.trim(field).toLowerCase() == this.model.get('name').toLowerCase()) {
				button.addClass('hide');
			} else {
				button.removeClass('hide');
				if(event.which == 13) {
        			button.trigger('click');
    			}
			}
		} else {
			if(value && field) {
				button.removeClass('hide');
				if(event.which == 13) {
        			button.trigger('click');
    			}
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
		_.each(this.model.options.models, function(model) {
			if(model.get('_id') == id) {
				model.set('selected', true);
			} else {
				model.set('selected', false);
			}
		}, this);
	},

	saveSpec: function(event) {
		var self = this;
		var option = $('.spec', this.$el).val();
		var spec = $('.field', this.$el).val();

		if(this.model.get('_id') !== null) {
			if(this.model.get('name') != spec) {
				this.model.save({
					name: spec
				}, {
					wait: true,
					success: function(model, response) {
						self.saveOption();
					},
					error: function(model, response) {
						data = JSON.parse(response.responseText);
                    $(self.el).prev('.alert').remove();
                    $(self.el).before('<div class="row alert-box alert">Error: ' + data.error.message + '<a href="#" class="close" onclick="$(this).parent().fadeOut(500, function() { $(this).remove(); });">&times;</a></div>');
                }
				});
			} else {
				self.saveOption();
			}
		} else {
			this.model.save({
				name: spec
			}, {
				wait: true,
				success: function(model, response) {
					self.saveOption();
				},
				error: function(model, response) {
					data = JSON.parse(response.responseText);
                    $(self.el).prev('.alert').remove();
                    $(self.el).before('<div class="row alert-box alert">Error: ' + data.error.message + '<a href="#" class="close" onclick="$(this).parent().fadeOut(500, function() { $(this).remove(); });">&times;</a></div>');
                }
			});
		}


	},

	saveOption: function() {
		var self = this;
		var option = $('.spec', this.$el).val();
		var spec = $('.field', this.$el).val();

		var match = _.find(this.getOptionsList(), function(val) {
			return val.toLowerCase() == $.trim(option).toLowerCase();
		});

		if(match) {
			var options = this.model.options.where({
				name: match
			});

			options[0].save({}, {
				success: function(model, response) {
					self.setSelectedOption(response._id);
					self.showSaveButton();
					$('.spec', self.$el).focus().autocomplete("option", {
						source: self.getOptionsList()
					}).data("autocomplete").search('');
				},
				error: function(model, response) {
					data = JSON.parse(response.responseText);
                    $(self.el).prev('.alert').remove();
                    $(self.el).before('<div class="row alert-box alert">Error: ' + data.error.message + '<a href="#" class="close" onclick="$(this).parent().fadeOut(500, function() { $(this).remove(); });">&times;</a></div>');
                }
			});
		} else {
			var o = new Option({
				name: option,
				selected: false,
				product_id: this.model.get('product_id'),
				spec_id: this.model.get('_id')
			});

			this.model.options.add(o);

			o.save({}, {
				success: function(model, response) {
					self.setSelectedOption(response._id);
					self.showSaveButton();
					$('.spec', self.$el).focus().autocomplete("option", {
						source: self.getOptionsList()
					}).data("autocomplete").search('');
					//$('.spec', self.$el).trigger('keyup');
				},
				error: function(model, response) {
					data = JSON.parse(response.responseText);
                    $(self.el).prev('.alert').remove();
                    $(self.el).before('<div class="row alert-box alert">Error: ' + data.error.message + '<a href="#" class="close" onclick="$(this).parent().fadeOut(500, function() { $(this).remove(); });">&times;</a></div>');
                }
			});
		}
	}
});