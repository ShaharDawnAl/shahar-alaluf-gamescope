<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/siteicon.png">
    <title>Game Scope - Loading...</title>
</head>

<body style="width: 80%; background: url(images/loading.gif) no-repeat center center fixed; 
	background-size: 50%;">
</body>

</html>

<?php
require_once "inputCheck.php";

if (!is_session_started())
		{
			session_start();
		}
		if ($_SESSION)
		{
			unset($_SESSION['username']);
			unset($_SESSION['password']);
			unset($_SESSION['useradmin']);
			session_destroy();
			header("Location:index.php");
		}
		else
		{
			session_destroy();
			header("Location:index.php");
		}
?>
