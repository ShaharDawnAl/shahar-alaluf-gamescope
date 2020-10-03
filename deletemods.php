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
	require_once "inputCheck.php";
	
	if (!is_session_started())
	{
		session_start();
	}
	if (!$_SESSION)
	{
		session_destroy();
		header("Location: index.php");
	}
	
	//check if not admin, head to home page
	if (!$_SESSION['useradmin'])
	{
		header("Location: index.php");
	}
	if ($_SESSION['useradmin'])
	{
		if (isset($_GET['Delete']))
		{
			$db = new dbClass();
			$delid = $_GET['Delete'];
			$db->deleteMods($delid);
			$db = null;
			header('Location: index.php');
		}
	}
?>
