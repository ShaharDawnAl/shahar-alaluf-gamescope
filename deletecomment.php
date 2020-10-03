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
	$db = new dbClass();
	
	if (!isset($_GET['Delete']))
		header("Location: index.php");
	
	//check if not admin, or if the comment does not belong to this user
	if (!$_SESSION['useradmin'] && ($db->getCommentUserIdById($_GET['Delete']) != $db->getUserByUserName($_SESSION['username'])))
	{
		header("Location: index.php");
		$db = null;
	}
	
	
	if (isset($_GET['Delete']))
	{
		$table = $_SESSION['table'];
		unset($_SESSION['table']);
		$delid = $_GET['Delete'];
		$db->deleteCommentQuery($table, $delid);
		$db = null;
		header("Location: ". $_SERVER['HTTP_REFERER']."#comment");
	}
?>
