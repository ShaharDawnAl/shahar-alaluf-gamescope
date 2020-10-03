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
	require_once "tables/news.php";
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
	
	if(empty($_POST))
		header("Location: index.php");
	
	//add comment if button clicked
	if (isset($_POST['addnewscommentbtn']))
	{											
		$db = new dbClass();
		$newsid = $_SESSION['newspage'];
		$newscomment = $_POST['newscomment'];
		$username = $_SESSION['username'];
		$userid = $db->getUserByUserName($username);
		$db->addComment($newscomment, $userid);
		$db->castNewsComment($newsid);
		
		$db = null;
		header("Location: newscontent.php?newspage=".$newsid."#details");
	}	
	
	if (isset($_POST['addmodscommentbtn']))
	{											
		$db = new dbClass();
		$modsid = $_SESSION['modspage'];
		$modscomment = $_POST['modscomment'];
		$username = $_SESSION['username'];
		$userid = $db->getUserByUserName($username);
		$db->addComment($modscomment, $userid);
		$db->castModsComment($modsid);
		
		$db = null;
		header("Location: modscontent.php?modspage=".$modsid."#details");
	}

	if (isset($_POST['addcodescommentbtn']))
	{											
		$db = new dbClass();
		$codesid = $_SESSION['codespage'];
		$codescomment = $_POST['codescomment'];
		$username = $_SESSION['username'];
		$userid = $db->getUserByUserName($username);
		$db->addComment($codescomment, $userid);
		$db->castCodesComment($codesid);
		
		$db = null;
		header("Location: codescontent.php?codespage=".$codesid."#details");
	}
	
	if (isset($_POST['addtrainerscommentbtn']))
	{											
		$db = new dbClass();
		$trainersid = $_SESSION['trainerspage'];
		$trainerscomment = $_POST['trainerscomment'];
		$username = $_SESSION['username'];
		$userid = $db->getUserByUserName($username);
		$db->addComment($trainerscomment, $userid);
		$db->castTrainersComment($trainersid);
		
		$db = null;
		header("Location: trainerscontent.php?trainerspage=".$trainersid."#details");
	}
	
	if (isset($_POST['addwalkthroughscommentbtn']))
	{											
		$db = new dbClass();
		$walkthroughsid = $_SESSION['walkthroughspage'];
		$walkthroughscomment = $_POST['walkthroughscomment'];
		$username = $_SESSION['username'];
		$userid = $db->getUserByUserName($username);
		$db->addComment($walkthroughscomment, $userid);
		$db->castWalkthroughsComment($walkthroughsid);
		
		$db = null;
		header("Location: walkthroughscontent.php?walkthroughspage=".$walkthroughsid."#details");
	}
	
?>