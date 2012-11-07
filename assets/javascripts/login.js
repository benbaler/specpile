require.config({
	paths: {
		jquery: 'libs/jquery.min',
		underscore: 'libs/underscore.min',
		backbone: 'libs/backbone.min'
	}

});

require(['models/login', 'views/login'], function(LoginCredentials, Login) {
	var loginCredentials = new LoginCredentials({});

	var login = new Login({
		model: loginCredentials
	});
});