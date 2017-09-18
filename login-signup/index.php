<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Sign Up Login Function</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

        <style type="text/css">
            .container {
                padding-top: 15px;
            }
            #loginAlert {
                display: none;
            }
            #emailSection {
                display: none;
            }
            #toggleLogin {
                color: cornflowerblue;
                margin-right: 15px;
                cursor: pointer;
            }
            #toggleLogin:hover {
                color: blue;
                cursor: pointer;
            }
            #btnLogout {
                display: none;
            }
        </style>
    </head>
    <body onload="getCookie();">
        <nav class="navbar navbar-light bg-faded">
            <form class="form-inline">
                <a class="navbar-brand my-2 my-lg-0 col-9" href="index.php">Sign Up Login Function</a>
                <form class="form-inline my-2 my-lg-0 col-3">
                    <button id="btnLoginSignup" class="btn btn-outline-success my-2 my-sm-0" type="button">Login/SignUp</button>
                    <button id="btnLogout" class="btn btn-outline-success my-2 my-sm-0" type="button">Logout</button>
                </form>
            </form>
        </nav>
        <div id="container" class="container">
            <h3 id="formTitle">Login</h3>
            <form>
                <input id="loginActive" type="hidden" name="loginActive" value="1">
                <div class="alert alert-danger" id="loginAlert"></div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Username" aria-describedby="usernameHelp">
                    <small id="usernameHelp" class="form-text text-muted">Please enter an username within 12 English characters and/or digits.</small>
                </div>
                <div class="form-group" id="emailSection">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">We will never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password">
                </div>
                <a id="toggleLogin">Sign Up</a>
                <button id="loginSignupBtn" type="button" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <!-- jQuery first, then Tether, then Bootstrap JS. -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

        <script type="text/javascript">
            //set checking cookie function for body to run everytime the page loads
            function getCookie() {
                var name = "id" + "=";
                var decodedCookie = decodeURIComponent(document.cookie);
                var ca = decodedCookie.split(';');
                for(var i = 0; i <ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') {
                        c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                        $("#btnLoginSignup").hide();
                        $("#btnLogout").show();
                        $("#container").html("<h3>You have successfully logged in!</h3>");
                    }
                }                
            }
        
            //toggle between login and signup mode
            $("#toggleLogin").click(function() {
                if ($("#loginActive").val() == "1") {
                    $("#formTitle").html("Sign Up");
                    $("#emailSection").show();
                    $("#toggleLogin").html("Login");
                    $("#loginActive").val("0");
                } else {
                    $("#formTitle").html("Login");
                    $("#emailSection").hide();
                    $("#toggleLogin").html("Sign Up");
                    $("#loginActive").val("1");
                }
            })
            //ajax login signup info with db
            $("#loginSignupBtn").click(function() {
                $.ajax({
                    type: "POST",
                    url: "action.php?action=loginSignup",
                    data: "username=" + $("#username").val() + "&email=" + $("#email").val() + "&password=" + $("#password").val() + "&loginActive=" + $("#loginActive").val(),
                    success: function(result) {
                        if (result == "1") {
                            window.location.assign("http://idontwannarock-com.stackstaging.com/project/login-signup/");
                        } else {
                            $("#loginAlert").html(result).show();
                        }
                    }
                })
            })
            //ajax logout
            $("#btnLogout").click(function() {
                $.ajax({
                    type: "POST",
                    url: "action.php?action=logout",
                    success: function(result) {
                        if (result == "loggedout") {
                            window.location.assign("http://idontwannarock-com.stackstaging.com/project/login-signup/");
                        }
                    }
                })
            })
        </script>
    </body>
</html>