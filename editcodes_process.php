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
	require_once "tables/codes.php";
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
	$ctest = new Codes();
	$ctest = $db->getCodesByCodesId($_SESSION['codesId']);
	
	//check if not admin or created by current user, head to home page
	if (!$_SESSION['useradmin'] && $db->getUserByUserName($_SESSION['username'])!=$ctest->getCodesUserId())
	{
		$db = null;
		$ctest = null;
		header("Location: index.php");
	}
	$ctest = null;
	
	if(empty($_POST))
		header("Location: index.php");
	
	//edit Codes if button clicked
	if (isset($_POST['confirmcodesedit']))
	{							
		$codesid = $_SESSION['codesId'];
		unset($_SESSION['codesId']);
		$codestitle = $_POST['codesTitle'];
		$codesdescription = $_POST['codesDescription'];
		if (!empty($_POST['codesVideo']))
		{
			$codesvideo = $_POST['codesVideo'];
			if (isset($_SESSION['videoId']))
			{
				$codesvideoid = $_SESSION['videoId'];
				$videoflag = 1;
				unset($_SESSION['videoId']);
			}
			else
				$videoflag = 0;
		}
		
		if (isset($_POST['codesActive']))
			$codesactive = 1;
		else
			$codesactive = 0;
		
		
		if (is_uploaded_file($_FILES['codes_carousel_picture']['tmp_name']))
		{
			$f_name = $_FILES['codes_carousel_picture']['tmp_name'];
			if (!file_exists("tables_attrs/codes/codes_id_".$codesid))
				mkdir("tables_attrs/codes/codes_id_".$codesid);
			if (!file_exists("tables_attrs/codes/codes_id_".$codesid."/images/"))
				mkdir("tables_attrs/codes/codes_id_".$codesid."/images/");
			if (file_exists($f_name))
				move_uploaded_file($f_name, "tables_attrs/codes/codes_id_".$codesid."/images/".$_FILES['codes_carousel_picture']['name']);
			$codescarpic = "tables_attrs/codes/codes_id_".$codesid."/images/".$_FILES['codes_carousel_picture']['name'];
		}
		else
			$codescarpic = $_SESSION['oldCodesCarPic'];
		
		if (is_uploaded_file($_FILES['codes_box_picture']['tmp_name']))
		{
			$f_name = $_FILES['codes_box_picture']['tmp_name'];
			if (!file_exists("tables_attrs/codes/codes_id_".$codesid."/images/"))
				mkdir("tables_attrs/codes/codes_id_".$codesid."/images/");
			if (file_exists($f_name))
				move_uploaded_file($f_name, "tables_attrs/codes/codes_id_".$codesid."/images/".$_FILES['codes_box_picture']['name']);
			$codesboxpic = "tables_attrs/codes/codes_id_".$codesid."/images/".$_FILES['codes_box_picture']['name'];
		}
		else
			$codesboxpic = $_SESSION['oldCodesBoxPic'];
		
		unset($_SESSION['oldCodesCarPic']);
		unset($_SESSION['oldCodesBoxPic']);
		
		// edit Codes
		$c1 = new Codes();
		$c1->setCodesId($codesid);
		$c1->setCodesTitle($codestitle);
		$c1->setCodesDesc($codesdescription);
		$c1->setCodesCarPic($codescarpic);
		$c1->setCodesBoxPic($codesboxpic);
		$c1->setCodesActive($codesactive);
		
		$db->updateCodes($c1);
		if ($videoflag==1)
			$db->updateVideosQuery($codesvideoid, $codesvideo);
		if ($videoflag==0)
			$db->addVideo($codesvideo, "codes", $codesid);
		
		$db = null;
		
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
?>
