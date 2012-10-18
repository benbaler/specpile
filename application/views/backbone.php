<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">   
    <title>Simple Backbone Login UI</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="http://ajax.cdnjs.com/ajax/libs/json2/20110223/json2.js" type="text/javascript" charset="utf-8"></script>
    <script src="http://ajax.cdnjs.com/ajax/libs/underscore.js/1.1.6/underscore-min.js" type="text/javascript" charset="utf-8"></script>
    <script src="http://ajax.cdnjs.com/ajax/libs/backbone.js/0.3.3/backbone-min.js" type="text/javascript" charset="utf-8"></script>

    <script type="text/javascript">
    $(function() {

        window.CredentialsModel = Backbone.Model.extend({});

        window.LoginView = Backbone.View.extend({

            el: $('#login'),

            events: {
                "submit": "loginSubmit",
                "change #username": "usernameChange",
                "change #password": "passwordChange"
            },

            initialize: function () {
                _.bindAll(this, 'usernameChange', 'passwordChange', 'loginSubmit');
            },

            usernameChange: function(event) {
                this.model.set({ username: $(event.currentTarget).val() });
            },

            passwordChange: function(event) {
                this.model.set({ password: $(event.currentTarget).val() });
            },

            loginSubmit: function(event) {
                alert("You have logged in as '" + this.model.get('username') + "' and a password of '" + this.model.get('password') + "'");
                return false;
            }

        });

        var credentials = new CredentialsModel({
            username: '',
            password: ''
        });

        var login = new LoginView({ model: credentials });

    });
    </script>

    <style type="text/css">
        body {
            font-family: "Arial";
        }

        form {
            width: 400px;
            border: 1px solid #ccc;
            border-radius: 20px;
            padding: 20px;
            margin: 30px auto;
        }

        form label {
            display: inline-block;
            width: 100px;
        }

        form input[type="text"] {
            background: #fff;
            border: 1px solid #ccc;
            padding: 2px;
            margin: 0;
            width: 200px;
            font-size: 14px;
        }

        form .submit {
            margin: 0 0 0 100px;
        }
    </style>

</head>

<body>

    <form id="login" action="" method="post">
        <label for="username">Username</label><input id="username" type="text" /><br />
        <label for="password">Password</label><input id="password" type="text" /><br />
        <input class="submit" name="submit" type="submit" value="Submit" />
    </form>

</body>

</html>