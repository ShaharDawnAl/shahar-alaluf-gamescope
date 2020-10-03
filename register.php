<?php
	require_once "dbClass.php";
    require_once "inputCheck.php";
	
	//check if there is nothing in the session
	
		if (!is_session_started())
		{
			session_start();
		}
		if (!$_SESSION)
			session_destroy();

        if (isset($_SESSION['username']))
            header("Location: index.php");
?>

    <?php
	require_once "dbClass.php";
	require_once "inputCheck.php";
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>

            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="description" content="">
            <meta name="author" content="">
            <link rel="icon" href="images/siteicon.png">

            <title>Game Scope</title>

            <!-- Bootstrap Core CSS -->
            <link href="bootstrap-3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

            <!-- Custom CSS -->
            <link href="styles/site.css" rel="stylesheet">

            <!-- Custom Fonts -->
            <link href="font-awesome-4.7.0/css/font-awesome.css" rel="stylesheet" type="text/css">
            <link href="font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

            <script src="scripts/jquery.js"></script>
        </head>

        <body>
            <div class="background-image"></div>
            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                        <div class="logo" onclick="location.href = 'index.php';"></div>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right" id="navbar-middle">
                            <li>
                                <a href="index.php">Home</a>
                            </li>
                            <li>
                                <a href="news.php">News</a>
                            </li>
                            <li>
                                <a href="mods.php">Mods</a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cheats<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="codes.php">Codes</a>
                                    </li>
                                    <li>
                                        <a href="trainers.php">Trainers</a>
                                    </li>
                                    <li>
                                        <a href="walkthroughs.php">Walkthroughs</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="uploads.php">Uploads</a>
                            </li>
                            <li>
                                <a href="contact-us.php">Contact Us</a>
                            </li>
                            <!-- LOGIN/REGISTER BUTTON-->
                            <?php
						if (!is_session_started())
							echo '<button class="btn btn-primary" href="#signin" data-toggle="modal" data-target="#myModal">Sign In/Register</button>';
						
                        else
						{
							$db = new dbClass();
							$userid = $db->getUserByUserName($_SESSION['username']);
							$n1 = $db->getUserById($userid);
							echo '
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-circle-o" aria-hidden="true"></i>'.' '.$_SESSION['username'].'<b class="caret"></b></a>
                                        <ul class="dropdown-menu">';
											echo '
                                            <li>
                                                <div class="col-md-2"></div>
                                                    <div class="col-md-7">
                                                        <img src="'; echo $n1->getUserAvatar().'" alt="Alternate Text" class="img-responsive" width="120px" height="120px">
                                                    </div>
                                            </li>';
											if ($_SESSION['useradmin'])
                                                echo '
                                            <li>
                                                <a href="adminmanagment.php"><i class="fa fa-cogs" aria-hidden="true"></i>'.' '.'Admin</a>
                                            </li>';
											
											echo '
                                            <li>
                                                <a href="editprofile.php"><i class="fa fa-user-circle-o" aria-hidden="true"></i>'.' '.'Edit Profile</a>
                                            </li>

                                            <li>
                                                <a href="logout.php"><i class="fa fa-power-off" aria-hidden="true"></i>'.' '.'Sign out</a>
                                            </li>
                                        </ul>
                                    </li> 
								';
						}
						$n1 = null;
					?>

                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container -->
            </nav>

            <!-- Modal -->
            <div class="modal fade bs-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <br>
                        <div class="bs-example bs-example-tabs">
                            <ul id="myTab" class="nav nav-tabs">
                                <li class="active"><a href="#signin" data-toggle="tab">Sign In</a></li>
                                <li class=""><a href="#signup" data-toggle="tab">Register</a></li>
                                <li class=""><a href="#why" data-toggle="tab">Why?</a></li>
                            </ul>
                        </div>
                        <div class="modal-body">
                            <div id="myTabContent" class="tab-content">
                                <div class="tab-pane fade in" id="why">
                                    <p>We need this information so that you can receive access to the site and its content. Rest assured your information will not be sold, traded, or given to anyone.</p>
                                    <p><br>For more info please contact us through "Contact Us" tab.</p>
                                </div>
                                <div class="tab-pane fade active in" id="signin">
                                    <form class="form-horizontal" action="login.php" method="post">
                                        <fieldset>
                                            <!-- Sign In Form -->
                                            <!-- Text input-->
                                            <div class="control-group">
                                                <label class="control-label" for="usernameinput">Username:</label>
                                                <div class="controls">
                                                    <input required="" id="usernameinput" name="usernameinput" type="text" class="form-control input-medium" placeholder="Username" required="">
                                                </div>
                                            </div>

                                            <!-- Password input-->
                                            <div class="control-group">
                                                <label class="control-label" for="passwordinput">Password:</label>
                                                <div class="controls">
                                                    <input required="" id="passwordinput" name="passwordinput" class="form-control input-medium" type="password" placeholder="********">
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:2%;">

                                                <div class="form-group">
                                                    <a href="forgot.php"> Forgot Password? </a>
                                                </div>
                                            </div>

                                            <!-- Button -->
                                            <div class="control-group">
                                                <label class="control-label" for="signin"></label>
                                                <div class="controls">
                                                    <button id="signin" name="signin" class="btn btn-success">Sign In</button>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="signup">
                                    <form class="form-horizontal" action="register.php" method="post">
                                        <fieldset>
                                            <!-- Sign Up Form -->
                                            <!-- Text input-->
                                            <?php
										$db = new dbClass();
										$errArray=array();
										
										$fname = $_POST['FName'];
										$lname = $_POST['LName'];
										$email = $_POST['Email'];
										$username = $_POST['username'];
										$password = $_POST['password'];
										$reenterpassword = $_POST['reenterpassword'];
										checkFName($fname,$errArray);
										checkLName($lname,$errArray);
										checkEmail($email,$errArray);
										checkUName($username,$errArray);
										checkPassword($password, $reenterpassword, $errArray);
										$db->checkEmailExists($email, $errArray);
										$db->checkUsernameExists($username, $errArray);
										
									?>

                                                <div class="control-group">
                                                    <label class="control-label" for="FName">First name:</label>
                                                    <div class="controls">

                                                        <input id="FName" name="FName" class="form-control input-large" type="text" placeholder="First name" <?php if (!empty($errArray)) echo 'value="'.$fname. '"'; ?> required="">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="LName">Last name:</label>
                                                    <div class="controls">
                                                        <input id="LName" name="LName" class="form-control input-large" type="text" placeholder="Last name" <?php if (!empty($errArray)) echo 'value="'.$lname. '"'; ?> required="">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="Email">Email:</label>
                                                    <div class="controls">
                                                        <input id="Email" name="Email" class="form-control input-large" type="text" placeholder="Email@email.com" <?php if (!empty($errArray)) echo 'value="'.$email. '"'; ?> required="">
                                                    </div>
                                                </div>

                                                <!-- Text input-->
                                                <div class="control-group">
                                                    <label class="control-label" for="username">Username:</label>
                                                    <div class="controls">
                                                        <input id="username" name="username" class="form-control input-large" type="text" placeholder="Username" <?php if (!empty($errArray)) echo 'value="'.$username. '"'; ?> required="">
                                                    </div>
                                                </div>

                                                <!-- Password input-->
                                                <div class="control-group">
                                                    <label class="control-label" for="password">Password:</label>
                                                    <div class="controls">
                                                        <input id="password" name="password" class="form-control input-large" type="password" placeholder="********" required="">
                                                        <em>1-8 Characters</em>
                                                    </div>
                                                </div>

                                                <!-- Text input-->
                                                <div class="control-group">
                                                    <label class="control-label" for="reenterpassword">Re-Enter Password:</label>
                                                    <div class="controls">
                                                        <input id="reenterpassword" class="form-control" name="reenterpassword" type="password" placeholder="********" class="input-large" required="">
                                                    </div>
                                                </div>

                                                <!-- Multiple Radios (inline) -->

                                                <!-- Button -->
                                                <div class="control-group">
                                                    <label class="control-label" for="confirmsignup"></label>
                                                    <div class="controls">
                                                        <button id="confirmsignup" name="confirmsignup" class="btn btn-success" type="submit">Sign Up</button>
                                                    </div>
                                                </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <center>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </center>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <div class="container">

                <figure>
                    <div class="banners"><img src="images/banner1.jpg" style="max-height:190px;"></div>
                </figure>

                <div class="row" id="details">
                    <div class="col-md-12">
                        <div class="adminman">
                            <div class="row" id="message-us">
                                <div class="title-contact-form">
                                    <p>
                                        <?php
							if (!isset($_POST['confirmsignup']))
							{
								header("Location: index.php");
							}
														
							
							if(empty($errArray)) //success
							{
								// create new user
								$u1 = new Users();
								$u1->setUserEmail($email);
								$u1->setUserPassword($password);
								$u1->setUserName($username);
								$u1->setUserFName($fname);
								$u1->setUserLName($lname);
								$avatar = "images/unavailable_avatar.png";
								$u1->setUserAvatar($avatar);
								$db->addUser_withEncr($u1);
								$db = null;
								echo('<img src="images\icons\success.ico" alt="success">'.' Registered Successfully');
							}
														
							else //failure
								echo('<img src="images\icons\failure.ico" alt="failure">'.' Registeration Error');
						?>
                                    </p>
                                </div>
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-8">
                                    <div class="well well-sm">
                                        <?php
									if(empty($errArray))//success
									{
										echo('Thank you for registering '.$username.'!'."<br>");
										echo('You may now login and enjoy everything this site can provide!');
									}
										
									else //failure
									{
										echo '<ul>';
										foreach($errArray as $err)
										{
											echo '<li>'.$err.'</li>';
										}
										echo '</ul>';
										echo '<div class="col-md-4"></div><button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Continue Registeration</button>';
									}
									$u1 = null;
								?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- Footer -->
                <footer>
                    <div class="row">
                        <div class="col-lg-12">
                            <h5>Copyright &copy; GameScope 2017</h5>
                        </div>
                    </div>
                </footer>

                <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>
            </div>
            <!-- /.container -->

            <!-- jQuery -->
            <script src="scripts/jquery.js"></script>
            <script src="scripts/site.js"></script>

            <!-- Bootstrap Core JavaScript -->
            <script src="bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>

        </body>

        </html>
