 $(function() {
     
    var Credentials = Backbone.Model.extend({
    });
    
    var Login = Backbone.View.extend({
        el: $('#login-form'),
        
        events: {
            'submit' : 'submitCredentials'
        },
        
        initialize: function(){
            _.bindAll(this, 'submitCredentials');
        },
        
        submitCredentials: function(event){
            this.model.set({email: $('#email').val(), pass: $('pass').val()});
            alert(this.model.email);
            return false;
        }
    });
    
    var credentials = new Credentials({
    });
    
    var login = new Login({
        model: credentials
    })
    
    
});