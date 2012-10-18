 $(function() {
     
    window.CredentialsModel = Backbone.Model.extend({});
    
    window.LoginView = Backbone.Model.extend({
        el: $('#login-form'),
        
        events: {
            "submit": "loginSubmit",
            "change #email": "emailChange",
            "change #pass": "passChange"
        },
            
        initialize: function () {
            _.bindAll(this, 'emailChange', 'passChange', 'loginSubmit');
        },

        emailChange: function(event) {
            this.model.set({
                email: $(event.currentTarget).val()
            });
        },

        passChange: function(event) {
            this.model.set({
                pass: $(event.currentTarget).val()
            });
        },

        loginSubmit: function(event) {
            alert("You have logged in as '" + this.model.get('email') + "' and a password of '" + this.model.get('pass') + "'");
            return false;
        }
            
    });
    
    var credentials = new CredentialsModel({
        email: '',
        pass: ''
    });

    var login = new LoginView({
        model: credentials
    });

});