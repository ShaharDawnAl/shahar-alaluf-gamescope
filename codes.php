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
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="nav-active">Cheats<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="codes.php" class="cheats-active">Codes</a>
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
                                                <div class="col-md-2"></div><div class="col-md-7">
                                                        <img src="'; echo $n1->getUserAvatar().'" alt="Alternate Text" class="img-responsive" width="80px" height="80px">
                                                    </div>
                                            </li>';
											if ($_SESSION['useradmin'])
                                                echo '
                                            <li>
                                                <a href="adminmanagment.php"><i class="fa fa-cogs" aria-hidden="true"></i>'.' '.'Admin</a>
                                            </li>';
											
											echo '
                                            <li>
                                                <a href="#mods" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-upload"" aria-hidden="true"></i>'.' '.'My Uploads</a>
                                            </li>
                                            
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

        <?php
        if (isset($_SESSION['username']))
        {
        
            ?>
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <br>
                        <div class="bs-example bs-example-tabs">
                            <ul id="myTab" class="nav nav-tabs">
                                <li class="active"><a href="#mods" data-toggle="tab">Mods</a></li>
                                <?php
                                    if ($_SESSION['useradmin'])
                                    {
                                ?>
                                    <li><a href="#news" data-toggle="tab">News</a></li>
                                    <?php
                                    }
                                ?>
                                        <li class=""><a href="#codes" data-toggle="tab">Codes</a></li>
                                        <li class=""><a href="#trainers" data-toggle="tab">Trainers</a></li>
                                        <li class=""><a href="#walkthroughs" data-toggle="tab">Walkthroughs</a></li>
                            </ul>
                        </div>
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade active in" id="mods">
                                <div class="row" id="details">
                                    <div class="col-md-12">
                                        <div class="adminman">
                                            <div class="row" id="message-us">
                                                <div class="title-contact-form">
                                                    <p>Mods Contents</p>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="well well-sm table-responsive" style="overflow:auto; height: 280px;">
                                                        <?php
									$db = new dbClass();
									$modsArr = $db->getUserTableQuery("mods", $db->getUserByUserName($_SESSION['username']));
									
									echo "<table class='table'>
									<tr>
									<th>ID</th>
									<th>Title</th>
									<th>Description</th>
									<th>Date</th>
									<th>Approved</th>
									<th>By User</th>
									<th>Edit</th>";
                                    if ($_SESSION['useradmin'])
                                        echo "<th>Delete</th>";
									echo "</tr>";
									for ($i=0;$i<count((array)$modsArr);$i++)
									{   
										if ($modsArr[$i]->getModsActive() == 1)
											$isactive = "Approved";
										else
											$isactive = "Not Approved";
										echo "<tr>
										<td>".$modsArr[$i]->getModsId()."</td>
										<td><a style='color: skyblue;' href='modscontent.php?modspage=".$modsArr[$i]->getModsId()."'>".$modsArr[$i]->getModsTitle()."</td>
										<td>".substr($modsArr[$i]->getModsDesc(), 0, 10)."...</td>
										<td>".$modsArr[$i]->getModsDate()."</td>";
										if ($isactive == "Approved")
                                            echo "<td><b style='color: lightgreen;'>".$isactive."</b></td>"; 
                                        else
                                            echo "<td><b style='color: red;'>".$isactive."</b></td>"; 
										$modsUsername = $db->getUsernameById($modsArr[$i]->getModsUserId());
										echo "
										<td>".$modsUsername."</td>
										<td><a href='editmod.php?Edit=".$modsArr[$i]->getModsId()."'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a></td>";
                                        if ($_SESSION['useradmin'])
                                            echo "
                                        <td><a href='deletemods.php?Delete=".$modsArr[$i]->getModsId()."'><i class='fa fa-trash' aria-hidden='true'></a></i></td>
										</tr>";
									}
									echo "</table>";
									$db = null;
								?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade in" id="news">
                                <div class="row" id="details">
                                    <div class="col-md-12">
                                        <div class="adminman">
                                            <div class="row" id="message-us">
                                                <div class="title-contact-form">
                                                    <p>News Contents</p>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="well well-sm table-responsive" style="overflow:auto; height: 280px;">
                                                        <?php
									$db = new dbClass();
									$newsArr = $db->getUserTableQuery("news", $db->getUserByUserName($_SESSION['username']));
									
									echo "<table class='table'>
									<tr>
									<th>ID</th>
									<th>Title</th>
									<th>Description</th>
									<th>Date</th>
									<th>By User</th>
									<th>Edit</th>
									<th>Delete</th>
									</tr>";
									for ($i=0;$i<count((array)$newsArr);$i++)
									{   
										echo "<tr>
										<td>".$newsArr[$i]->getNewsId()."</td>
																				<td><a style='color: skyblue;' href='newscontent.php?newspage=".$newsArr[$i]->getNewsId()."'>".$newsArr[$i]->getNewsTitle()."</td>
										<td>".substr($newsArr[$i]->getNewsDesc(), 0, 10)."...</td>
										<td>".$newsArr[$i]->getNewsDate()."</td>";
										$newsUsername = $db->getUsernameById($newsArr[$i]->getNewsUserId());
										echo "
										<td>".$newsUsername."</td>
										<td><a href='editnew.php?Edit=".$newsArr[$i]->getNewsId()."'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a></td>
										<td><a href='deletenews.php?Delete=".$newsArr[$i]->getNewsId()."'><i class='fa fa-trash' aria-hidden='true'></a></i></td>
										</tr>";
									}
									echo "</table>";
									$db = null;
								?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade in" id="codes">
                                <div class="row" id="details">
                                    <div class="col-md-12">
                                        <div class="adminman">
                                            <div class="row" id="message-us">
                                                <div class="title-contact-form">
                                                    <p>Codes Contents</p>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="well well-sm table-responsive" style="overflow:auto; height: 280px;">
                                                        <?php
									$db = new dbClass();
									$codesArr = $db->getUserTableQuery("codes", $db->getUserByUserName($_SESSION['username']));
									
									echo "<table class='table'>
									<tr>
									<th>ID</th>
									<th>Title</th>
									<th>Description</th>
									<th>Date</th>
									<th>Approved</th>
									<th>By User</th>
									<th>Edit</th>";
                                    if ($_SESSION['useradmin'])
                                        echo "<th>Delete</th>";
									echo "</tr>";
									for ($i=0;$i<count((array)$codesArr);$i++)
									{   
										if ($codesArr[$i]->getCodesActive() == 1)
											$isactive = "Approved";
										else
											$isactive = "Not Approved";
										echo "<tr>
										<td>".$codesArr[$i]->getCodesId()."</td>
										<td><a style='color: skyblue;' href='codescontent.php?codespage=".$codesArr[$i]->getCodesId()."'>".$codesArr[$i]->getCodesTitle()."</td>
										<td>".substr($codesArr[$i]->getCodesDesc(), 0, 10)."...</td>
										<td>".$codesArr[$i]->getCodesDate()."</td>";
										if ($isactive == "Approved")
                                            echo "<td><b style='color: lightgreen;'>".$isactive."</b></td>"; 
                                        else
                                            echo "<td><b style='color: red;'>".$isactive."</b></td>"; 
										$codesUsername = $db->getUsernameById($codesArr[$i]->getcodesUserId());
										echo "
										<td>".$codesUsername."</td>
										<td><a href='editcode.php?Edit=".$codesArr[$i]->getCodesId()."'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a></td>";
                                        if ($_SESSION['useradmin'])
                                            echo "
                                        <td><a href='deletecodes.php?Delete=".$codesArr[$i]->getCodesId()."'><i class='fa fa-trash' aria-hidden='true'></a></i></td>
										</tr>";
									}
									echo "</table>";
									$db = null;
								?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade in" id="trainers">
                                <div class="row" id="details">
                                    <div class="col-md-12">
                                        <div class="adminman">
                                            <div class="row" id="message-us">
                                                <div class="title-contact-form">
                                                    <p>Trainers Contents</p>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="well well-sm table-responsive" style="overflow:auto; height: 280px;">
                                                        <?php
									$db = new dbClass();
									$trainersArr = $db->getUserTableQuery("trainers", $db->getUserByUserName($_SESSION['username']));
									
									echo "<table class='table'>
									<tr>
									<th>ID</th>
									<th>Title</th>
									<th>Description</th>
									<th>Date</th>
									<th>Approved</th>
									<th>By User</th>
									<th>Edit</th>";
                                    if ($_SESSION['useradmin'])
                                        echo "<th>Delete</th>";
									echo "</tr>";
									for ($i=0;$i<count((array)$trainersArr);$i++)
									{   
										if ($trainersArr[$i]->getTrainersActive() == 1)
											$isactive = "Approved";
										else
											$isactive = "Not Approved";
										echo "<tr>
										<td>".$trainersArr[$i]->getTrainersId()."</td>
										<td><a style='color: skyblue;' href='trainerscontent.php?trainerspage=".$trainersArr[$i]->getTrainersId()."'>".$trainersArr[$i]->getTrainersTitle()."</td>
										<td>".substr($trainersArr[$i]->getTrainersDesc(), 0, 10)."...</td>
										<td>".$trainersArr[$i]->getTrainersDate()."</td>";
										if ($isactive == "Approved")
                                            echo "<td><b style='color: lightgreen;'>".$isactive."</b></td>"; 
                                        else
                                            echo "<td><b style='color: red;'>".$isactive."</b></td>"; 
										$trainersUsername = $db->getUsernameById($trainersArr[$i]->getTrainersUserId());
										echo "
										<td>".$trainersUsername."</td>
										<td><a href='edittrainer.php?Edit=".$trainersArr[$i]->getTrainersId()."'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a></td>";
                                        if ($_SESSION['useradmin'])
                                            echo "
                                        <td><a href='deletetrainers.php?Delete=".$trainersArr[$i]->getTrainersId()."'><i class='fa fa-trash' aria-hidden='true'></a></i></td>
										</tr>";
									}
									echo "</table>";
									$db = null;
								?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade in" id="walkthroughs">
                                <div class="row" id="details">
                                    <div class="col-md-12">
                                        <div class="adminman">
                                            <div class="row" id="message-us">
                                                <div class="title-contact-form">
                                                    <p>Walkthroughs Contents</p>
                                                </div>
                                                <div class="well well-sm table-responsive" style="overflow:auto; height: 280px;">
                                                    <?php
									$db = new dbClass();
									$walkthroughsArr = $db->getUserTableQuery("walkthroughs", $db->getUserByUserName($_SESSION['username']));
									
									echo "<table class='table'>
									<tr>
									<th>ID</th>
									<th>Title</th>
									<th>Description</th>
									<th>Date</th>
									<th>Approved</th>
									<th>By User</th>
									<th>Edit</th>";
                                    if ($_SESSION['useradmin'])
                                        echo "<th>Delete</th>";
									echo "</tr>";
									for ($i=0;$i<count((array)$walkthroughsArr);$i++)
									{   
										if ($walkthroughsArr[$i]->getWalkthroughsActive() == 1)
											$isactive = "Approved";
										else
											$isactive = "Not Approved";
										echo "<tr>
										<td>".$walkthroughsArr[$i]->getWalkthroughsId()."</td>
										<td><a style='color: skyblue;' href='walkthroughscontent.php?walkthroughspage=".$walkthroughsArr[$i]->getWalkthroughsId()."'>".$walkthroughsArr[$i]->getWalkthroughsTitle()."</td>
										<td>".substr($walkthroughsArr[$i]->getWalkthroughsDesc(), 0, 10)."...</td>
										<td>".$walkthroughsArr[$i]->getWalkthroughsDate()."</td>";
										if ($isactive == "Approved")
                                            echo "<td><b style='color: lightgreen;'>".$isactive."</b></td>"; 
                                        else
                                            echo "<td><b style='color: red;'>".$isactive."</b></td>"; 
										$walkthroughsUsername = $db->getUsernameById($walkthroughsArr[$i]->getWalkthroughsUserId());
										echo "
										<td>".$walkthroughsUsername."</td>
										<td><a href='editwalkthrough.php?Edit=".$walkthroughsArr[$i]->getWalkthroughsId()."'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a></td>";
                                        if ($_SESSION['useradmin'])
                                            echo "
                                        <td><a href='deletewalkthroughs.php?Delete=".$walkthroughsArr[$i]->getWalkthroughsId()."'><i class='fa fa-trash' aria-hidden='true'></a></i></td>
										</tr>";
									}
									echo "</table>";
								?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

            <?php
        }
        ?>

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
                                        <form class="form-horizontal" action="register.php" method="post" enctype="multipart/form-data">
                                            <fieldset>
                                                <!-- Sign Up Form -->
                                                <!-- Text input-->
                                                <div class="control-group">
                                                    <label class="control-label" for="FName">First name:</label>
                                                    <div class="controls">
                                                        <input id="FName" name="FName" class="form-control input-large" type="text" placeholder="First name" required="">
                                                        <em>Lowercase/Uppercase only</em>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="LName">Last name:</label>
                                                    <div class="controls">
                                                        <input id="LName" name="LName" class="form-control input-large" type="text" placeholder="Last name" required="">
                                                        <em>Lowercase/Uppercase only</em>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="Email">Email:</label>
                                                    <div class="controls">
                                                        <input id="Email" name="Email" class="form-control input-large" type="text" placeholder="Email@email.com" required="">
                                                        <em>Email format</em>
                                                    </div>
                                                </div>

                                                <!-- Text input-->
                                                <div class="control-group">
                                                    <label class="control-label" for="username">Username:</label>
                                                    <div class="controls">
                                                        <input id="username" name="username" class="form-control input-large" type="text" placeholder="Username" required="">
                                                        <em>5-11 Characters</em>
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
                                                        <input id="reenterpassword" class="form-control input-large" name="reenterpassword" type="password" placeholder="********" required="">
                                                    </div>
                                                </div>

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

                <div class="banners-car"></div>




                <?php
            // Get the codes for front page ordered by date!
            $db = new dbClass();
            $codesbydate = $db->getCodesFrontDateOrdered();
            if (count((array)$codesbydate)<3)
            {
                $codesbydate[0] = new codes();
                $codesbydate[0]->setCodesId(0);
                $codesbydate[1] = new Codes();
                $codesbydate[1]->setCodesId(0);
                $codesbydate[2] = new Codes();
                $codesbydate[2]->setCodesId(0);
            }
            $countcodes = count((array)$codesbydate);
        ?>
                    <!-- Header Carousel -->
                    <header id="myCarousel" class="carousel slide">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" style="border-top:2px solid white; border-bottom:1px solid white">
                            <div class="item active">
                                <?php
                            $codesid = $codesbydate[0]->getCodesId();
                            $c1 = $db->getCodesByCodesId($codesid);
                        ?>
                                    <div id="carouselStyle" class="fill" style="background-image:url('<?php echo $c1->getCodesCarPic(); ?>');"></div>
                                    <div class="carousel-caption">
                                        <h2>
                                            <?php
                                    // echo the title with checks
                                    if (strlen($c1->getCodesTitle())>40)
                                        echo substr($c1->getCodesTitle(), 0, 40)."...";
                                    else
                                    {
                                        echo $c1->getCodesTitle();
                                    }
                                ?>
                                        </h2>
                                    </div>
                            </div>
                            <?php
				        $codesid = $codesbydate[1]->getCodesId();
				        $c1 = $db->getCodesByCodesId($codesid);
                    ?>
                                <div class="item">
                                    <div class="fill" style="background-image:url('<?php echo $c1->getCodesCarPic(); ?>');"></div>
                                    <div class="carousel-caption">
                                        <h2>
                                            <?php
                                        // echo the title with checks
				                        if (strlen($c1->getCodesTitle())>40)
								            echo substr($c1->getCodesTitle(), 0, 40)."...";
                                        else
                                        {
                                            echo $c1->getCodesTitle();
                                        }
                                    ?>
                                        </h2>
                                    </div>
                                </div>
                                <?php
                        $codesid = $codesbydate[2]->getCodesId();
                        $c1 = $db->getCodesByCodesId($codesid);
				    ?>
                                    <div class="item">
                                        <div class="fill" style="background-image:url('<?php echo $c1->getCodesCarPic(); ?>');"></div>
                                        <div class="carousel-caption">
                                            <h2>
                                                <?php
				                        // echo the title with checks
                                        if (strlen($c1->getCodesTitle())>40)
				                        echo substr($c1->getCodesTitle(), 0, 40)."...";
				                        else
				                        {
				                            echo $c1->getCodesTitle();
				                        }
                                    ?>
                                            </h2>
                                        </div>
                                    </div>
                        </div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                            <span class="icon-prev"></span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                            <span class="icon-next"></span>
                        </a>
                    </header>

                    <!-- Page Content -->
                    <div class="container">


                        <div class="row">
                            <nav class="navbar navbar-default" role="navigation" id="home-search">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse" style="background-color: #092656;">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                                    <div class="navbar-brand" style="color: white; font-size: 30px;">Codes</div>
                                </div>
                                <!-- Collect the nav links, forms, and other content for toggling -->
                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse">
                                    <form class="navbar-form col-lg-5" id="navbar-form1" role="search" action="search.php" method="post">
                                        <select class="form-control" id="form-control1" name="searchOpt" style="color: black;">
                                    <option value="news">News</option>
                                    <option value="mods">Mods</option>
                                    <option value="codes">Codes</option>
                                    <option value="trainers">Trainers</option>
                                    <option value="walkthroughs">Walkthroughs</option>
                                </select>

                                        <div class="input-group custom-search-form">
                                            <input type="text" class="form-control" id="form-control2" placeholder="Search" name="q" pattern=".{3,}" required="" title="3 Characters minimum!">
                                            <div class="input-group-btn">
                                                <button class="btn btn-default" name="btnSearch" type="submit" id="searchbtn"><i class="glyphicon glyphicon-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.navbar-collapse -->
                            </nav>
                        </div>

                        <div class="row">
                            <div class="col-md-12" style="">
                                <div class="demo demo4_top">
                                    <div class="paging-top">
                                        <?php
                                    include("pagination/paginator.php");
                                    $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
                                    $limit = 6;
                                    $startpoint = ($page * $limit) - $limit;
                                    $statement = "codes order by codes_date DESC";
                                    echo pagination("codes", $statement,$limit,$page);
                                ?>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="more-news">
                            <?php 
                        $db = new dbClass();
                        $codesArray=$db->getCodesOrdered($startpoint, $limit);
                        for ($i=0;$i<count((array)$codesArray);$i++)
                        {
                            if ($i%2==0 && $i!=0)
                            {
                                echo '<hr class="more-news-hr">';
                            }
                            echo '
                            <div class="more-news-blog">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4><strong><a href="codescontent.php?codespage='.$codesArray[$i]->getCodesId().'" class="blog-title">'.$codesArray[$i]->getCodesTitle().'</a></strong></h4>
                                    </div>
                                </div>

                                <div class="row" style="padding:1%; word-wrap: break-word;">
                                    <div class="col-md-3">
                                        <a href="codescontent.php?codespage='.$codesArray[$i]->getCodesId().'">
                                            <img class="news-images" src="'.$codesArray[$i]->getCodesBoxPic().'" alt="">
                                        </a>
                                    </div>
                                    
                                    <div class="col-md-9">
                                        <p>'.substr($codesArray[$i]->getCodesDesc(), 0, 200)."...".'</p>
                                        <p>Codes by: '.$db->getUsernameById($codesArray[$i]->getCodesUserId()).'</p>
                                        <p><a href="codescontent.php?codespage='.$codesArray[$i]->getCodesId().'" class="btn-readmore-blog">Read more</a></p>
                                    </div>
                                </div>
                            </div>';
                        }
                    ?>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="demo demo4_bottom">
                                    <?php
                                echo pagination("codes", $statement,$limit,$page);
                            ?>
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

                        <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a> </div>
                    <!-- /.container -->

                    <!-- jQuery -->
                    <script src="scripts/jquery.js"></script>
                    <script src="scripts/site.js"></script>

                    <!-- Bootstrap Core JavaScript -->
                    <script src="bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>

                    <!-- Script to Activate the Carousel -->
                    <script>
                        $('.carousel').carousel({
                            interval: 5000 //changes the speed
                        })

                    </script>

    </body>

    </html>
