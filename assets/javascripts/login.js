head.js('/assets/javascripts/libs/jquery.js', '/assets/javascripts/libs/underscore.js', '/assets/javascripts/libs/backbone.js', '/assets/javascripts/libs/backbone-validation.js', '/assets/javascripts/models/loginCredentials_m.js', '/assets/javascripts/views/login_v.js', function() {
	$(document).ready(function(){
	var loginCredentials = new LoginCredentials({});

	var login = new Login({
		model: loginCredentials
	});
	});
});