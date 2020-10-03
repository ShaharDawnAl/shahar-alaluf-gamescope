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
	require_once "dbClass.php";
//if sign in button clicked
	if (isset($_POST['signin']))
	{
		$db = new dbClass();
		$errMsg = "";
		$username = $_POST['usernameinput'];
		$password = $_POST['passwordinput'];
		
		if($db->checkUserLogin($username, $password))
		{
			session_start();
			$userid = $db->getUserByUserName($username);
			$n1 = $db->getUserById($userid);
			$username = $n1->getUserName();
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;
            $_SESSION['useradmin'] = $useradmin = $db->getUserAdminByUserName($username);
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		else
		{
			echo("<script>alert('Username does not exist, or password does not match username!')</script>");
			echo("<script>window.location = window.history.back();</script>");
		}
	}
	else
		header("Location:index.php");
?>
