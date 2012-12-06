head.js('/assets/javascripts/libs/jquery.js', 
	'/assets/javascripts/libs/underscore.js', 
	'/assets/javascripts/libs/backbone.js', 
	'/assets/javascripts/libs/backbone-validation.js', 
	'/assets/javascripts/models/registerCredentials_m.js', 
	'/assets/javascripts/views/register_v.js', 
	function() {
	$(document).ready(function() {
		var registerCredentials = new RegisterCredentials({});

		var register = new Register({
			model: registerCredentials
		});
	});
});