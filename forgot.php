<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/siteicon.png">

    <title>Game Scope</title>
    
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap-3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            outline: none;
        }
        
        .form-control {
            position: relative;
            font-size: 16px;
            height: auto;
            padding: 10px;
            @include box-sizing(border-box);
            &:focus {
                z-index: 2;
            }
        }
        
        body {
            background: url(images/anywalls.com-27525.jpg) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
        
        .login-form {
            margin-top: 60px;
        }
        
        .form-links {
            text-align: center;
            margin-top: 1em;
            margin-bottom: 50px;
        }
        
        .form-links a {
            color: #fff;
        }

    </style>

    <!-- Custom Fonts -->
    <link href="font-awesome-4.7.0/css/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>

<body>


    <section class="login-form" style="margin-top:1.5%;">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">
                        <h3><i class="fa fa-lock fa-4x"></i></h3>
                        <h2 class="text-center">Forgot Password?</h2>
                        <p>You can reset your password here.</p>
                        <div class="panel-body">

                            <form id="register-form" role="form" autocomplete="off" class="form" method="post" action="forgot_process.php">

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user-circle-o"></i></span>
                                        <input id="fname" name="fname" pattern="[A-Za-z]{1,}" placeholder="First name" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user-circle-o"></i></span>
                                        <input id="lname" name="lname" pattern="[A-Za-z]{1,}" placeholder="Last name" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                        <input id="email" name="email" placeholder="Email address" class="form-control" type="email" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input name="btnForgot" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-4"></div>




        <div class="col-md-12 col-lg-12">
            <div class="form-links" style="margin:0%;">
                <a href="index.php">www.gamescope.com</a>
            </div>
        </div>
    </section>
</body>

</html>
