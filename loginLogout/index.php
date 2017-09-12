<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Signup Login Function</title>

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
            }
            #toggleLogin:hover {
                color: blue;
                cursor: pointer;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">Signup Login Function</a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form class="form-inline my-2 my-lg-0">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Login</button>
                </form>
            </div>
        </nav>
        <div class="container">
            <h3 id="formTitle">Login</h3>
            <form>
                <input id="loginActive" type="hidden" name="loginActive" value="1">
                <div class="alert alert-danger" id="loginAlert"></div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Username" aria-describedby="usernameHelp">
                    <small id="usernameHelp" class="form-text text-muted">Please enter an username with 12 characters and/or digits top.</small>
                </div>
                <div class="form-group" id="emailSection">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password">
                </div>
                <a id="toggleLogin">SignUp</a>
                <button id="loginSignupBtn" type="button" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <!-- jQuery first, then Tether, then Bootstrap JS. -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
        <script type="text/javascript">
            //toggle between login and signup mode
            $("#toggleLogin").click(function() {
                if ($("#loginActive").val() == "1") {
                    $("#formTitle").html("Sign Up");
                    $("#emailSection").show();
                    $("toggleLogin").html("Login");
                    $("#loginActive").val("0");
                } else {
                    $("#formTitle").html("Login");
                    $("#emailSection").hide();
                    $("toggleLogin").html("SignUp");
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
                        if (result) {
                            $("#loginAlert").html(result).show();
                        }
                    }
                })
            })
        </script>
    </body>
</html>