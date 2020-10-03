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
	require_once "tables/walkthroughs.php";
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
	$wtest = new Walkthroughs();
	$wtest = $db->getWalkthroughsByWalkthroughsId($_SESSION['walkthroughsId']);
	
	//check if not admin or created by current user, head to home page
	if (!$_SESSION['useradmin'] && $db->getUserByUserName($_SESSION['username'])!=$wtest->getWalkthroughsUserId())
	{
		$db = null;
		$wtest = null;
		header("Location: index.php");
	}
	$wtest = null;
	
	if(empty($_POST))
		header("Location: index.php");
	
	//edit walkthroughs if button clicked
	if (isset($_POST['confirmwalkthroughsedit']))
	{							
		$walkthroughsid = $_SESSION['walkthroughsId'];
		unset($_SESSION['walkthroughsId']);
		$walkthroughstitle = $_POST['walkthroughsTitle'];
		$walkthroughsdescription = $_POST['walkthroughsDescription'];
		if (!empty($_POST['walkthroughsVideo']))
		{
			$walkthroughsvideo = $_POST['walkthroughsVideo'];
			if (isset($_SESSION['videoId']))
			{
				$walkthroughsvideoid = $_SESSION['videoId'];
				$videoflag = 1;
				unset($_SESSION['videoId']);
			}
			else
				$videoflag = 0;
		}
		
		if (is_uploaded_file($_FILES['walkthroughs_pictures']['tmp_name'][0]))
		{
			$picturesArray = array();
			$walkthroughsaddpiccount = count($_FILES['walkthroughs_pictures']['tmp_name']);
			$db->deletePictures("walkthroughs", $walkthroughsid);
		}
		
		else
			$walkthroughsaddpiccount = 0;
		if (isset($_POST['walkthroughsActive']))
			$walkthroughsactive = 1;
		else
			$walkthroughsactive = 0;

		
		for ($i=0; $i<$walkthroughsaddpiccount;$i++)
		{
			if (isset($_FILES['walkthroughs_pictures']['tmp_name'][$i]))
			{
				$f_name = $_FILES['walkthroughs_pictures']['tmp_name'][$i];
				if (!file_exists("tables_attrs/walkthroughs/walkthroughs_id_".$walkthroughsid))
					mkdir("tables_attrs/walkthroughs/walkthroughs_id_".$walkthroughsid);
				if (!file_exists("tables_attrs/walkthroughs/walkthroughs_id_".$walkthroughsid."/images/"))
					mkdir("tables_attrs/walkthroughs/walkthroughs_id_".$walkthroughsid."/images/");
				if (file_exists($f_name))
					move_uploaded_file($f_name, "tables_attrs/walkthroughs/walkthroughs_id_".$walkthroughsid."/images/".$_FILES['walkthroughs_pictures']['name'][$i]);
				$picturesArray[$i] = "tables_attrs/walkthroughs/walkthroughs_id_".$walkthroughsid."/images/".$_FILES['walkthroughs_pictures']['name'][$i];
			}
		}
		if ($walkthroughsaddpiccount>0)
		{
			$db->deletePictures("walkthroughs", $walkthroughsid);
			$db->addPictures($picturesArray, 'walkthroughs', $walkthroughsid);
		}
		
		
		if (is_uploaded_file($_FILES['walkthroughs_carousel_picture']['tmp_name']))
		{
			$f_name = $_FILES['walkthroughs_carousel_picture']['tmp_name'];
			if (!file_exists("tables_attrs/walkthroughs/walkthroughs_id_".$walkthroughsid))
				mkdir("tables_attrs/walkthroughs/walkthroughs_id_".$walkthroughsid);
			if (!file_exists("tables_attrs/walkthroughs/walkthroughs_id_".$walkthroughsid."/images/"))
				mkdir("tables_attrs/walkthroughs/walkthroughs_id_".$walkthroughsid."/images/");
			if (file_exists($f_name))
				move_uploaded_file($f_name, "tables_attrs/walkthroughs/walkthroughs_id_".$walkthroughsid."/images/".$_FILES['walkthroughs_carousel_picture']['name']);
			$walkthroughscarpic = "tables_attrs/walkthroughs/walkthroughs_id_".$walkthroughsid."/images/".$_FILES['walkthroughs_carousel_picture']['name'];
		}
		else
			$walkthroughscarpic = $_SESSION['oldWalkthroughsCarPic'];
		
		if (is_uploaded_file($_FILES['walkthroughs_box_picture']['tmp_name']))
		{
			$f_name = $_FILES['walkthroughs_box_picture']['tmp_name'];
			if (!file_exists("tables_attrs/walkthroughs/walkthroughs_id_".$walkthroughsid."/images/"))
				mkdir("tables_attrs/walkthroughs/walkthroughs_id_".$walkthroughsid."/images/");
			if (file_exists($f_name))
				move_uploaded_file($f_name, "tables_attrs/walkthroughs/walkthroughs_id_".$walkthroughsid."/images/".$_FILES['walkthroughs_box_picture']['name']);
			$walkthroughsboxpic = "tables_attrs/walkthroughs/walkthroughs_id_".$walkthroughsid."/images/".$_FILES['walkthroughs_box_picture']['name'];
		}
		else
			$walkthroughsboxpic = $_SESSION['oldWalkthroughsBoxPic'];
		
		unset($_SESSION['oldWalkthroughsCarPic']);
		unset($_SESSION['oldWalkthroughsBoxPic']);
		
		// edit walkthroughs
		$w1 = new Walkthroughs();
		$w1->setWalkthroughsId($walkthroughsid);
		$w1->setWalkthroughsTitle($walkthroughstitle);
		$w1->setWalkthroughsDesc($walkthroughsdescription);
		$w1->setWalkthroughsCarPic($walkthroughscarpic);
		$w1->setWalkthroughsBoxPic($walkthroughsboxpic);
		$w1->setWalkthroughsActive($walkthroughsactive);
		
		$db->updateWalkthroughs($w1);
		if ($videoflag==1)
			$db->updateVideosQuery($walkthroughsvideoid, $walkthroughsvideo);
		if ($videoflag==0)
			$db->addVideo($walkthroughsvideo, "walkthroughs", $walkthroughsid);
		
		$db = null;
		
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
?>
