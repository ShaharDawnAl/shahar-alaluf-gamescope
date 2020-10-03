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
	require_once "tables/mods.php";
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
	$mtest = new Mods();
	$mtest = $db->getModsByModsId($_SESSION['modsId']);
	
	//check if not admin or created by current user, head to home page
	if (!$_SESSION['useradmin'] && $db->getUserByUserName($_SESSION['username'])!=$mtest->getModsUserId())
	{
		$db = null;
		$mtest = null;
		header("Location: index.php");
	}
	$mtest = null;
	
	if(empty($_POST))
		header("Location: index.php");
	
	//edit mods if button clicked
	if (isset($_POST['confirmmodsedit']))
	{							
		$modsid = $_SESSION['modsId'];
		unset($_SESSION['modsId']);
		$modstitle = $_POST['modsTitle'];
		$modsdescription = $_POST['modsDescription'];
		if (!empty($_POST['modsVideo']))
		{
			$modsvideo = $_POST['modsVideo'];
			if (isset($_SESSION['videoId']))
			{
				$modsvideoid = $_SESSION['videoId'];
				$videoflag = 1;
				unset($_SESSION['videoId']);
			}
			else
				$videoflag = 0;
		}
		
		if (is_uploaded_file($_FILES['mods_pictures']['tmp_name'][0]))
		{
			$picturesArray = array();
			$modsaddpiccount = count($_FILES['mods_pictures']['tmp_name']);
			$db->deletePictures("mods", $modsid);
		}
		
		else
			$modsaddpiccount = 0;
		if (isset($_POST['modsActive']))
			$modsactive = 1;
		else
			$modsactive = 0;

		
		for ($i=0; $i<$modsaddpiccount;$i++)
		{
			if (isset($_FILES['mods_pictures']['tmp_name'][$i]))
			{
				$f_name = $_FILES['mods_pictures']['tmp_name'][$i];
				if (!file_exists("tables_attrs/mods/mods_id_".$modsid))
					mkdir("tables_attrs/mods/mods_id_".$modsid);
				if (!file_exists("tables_attrs/mods/mods_id_".$modsid."/images/"))
					mkdir("tables_attrs/mods/mods_id_".$modsid."/images/");
				if (file_exists($f_name))
					move_uploaded_file($f_name, "tables_attrs/mods/mods_id_".$modsid."/images/".$_FILES['mods_pictures']['name'][$i]);
				$picturesArray[$i] = "tables_attrs/mods/mods_id_".$modsid."/images/".$_FILES['mods_pictures']['name'][$i];
			}
		}
		if ($modsaddpiccount>0)
		{
			$db->deletePictures("mods", $modsid);
			$db->addPictures($picturesArray, 'mods', $modsid);
		}
		
		if (is_uploaded_file($_FILES['mods_download']['tmp_name']))
		{
			$f_name = $_FILES['mods_download']['tmp_name'];
			if (!file_exists("tables_attrs/mods/mods_id_".$modsid))
				mkdir("tables_attrs/mods/mods_id_".$modsid);
			if (!file_exists("tables_attrs/mods/mods_id_".$modsid."/download/"))
				mkdir("tables_attrs/mods/mods_id_".$modsid."/download/");
			if (file_exists($f_name))
				move_uploaded_file($f_name, "tables_attrs/mods/mods_id_".$modsid."/download/".$_FILES['mods_download']['name']);
			$modsdownload = "tables_attrs/mods/mods_id_".$modsid."/download/".$_FILES['mods_download']['name'];
		}
		else
			$modsdownload = $_SESSION['oldModsDownload'];
		
		
		if (is_uploaded_file($_FILES['mods_carousel_picture']['tmp_name']))
		{
			$f_name = $_FILES['mods_carousel_picture']['tmp_name'];
			if (!file_exists("tables_attrs/mods/mods_id_".$modsid))
				mkdir("tables_attrs/mods/mods_id_".$modsid);
			if (!file_exists("tables_attrs/mods/mods_id_".$modsid."/images/"))
				mkdir("tables_attrs/mods/mods_id_".$modsid."/images/");
			if (file_exists($f_name))
				move_uploaded_file($f_name, "tables_attrs/mods/mods_id_".$modsid."/images/".$_FILES['mods_carousel_picture']['name']);
			$modscarpic = "tables_attrs/mods/mods_id_".$modsid."/images/".$_FILES['mods_carousel_picture']['name'];
		}
		else
			$modscarpic = $_SESSION['oldModsCarPic'];
		
		if (is_uploaded_file($_FILES['mods_box_picture']['tmp_name']))
		{
			$f_name = $_FILES['mods_box_picture']['tmp_name'];
			if (!file_exists("tables_attrs/mods/mods_id_".$modsid."/images/"))
				mkdir("tables_attrs/mods/mods_id_".$modsid."/images/");
			if (file_exists($f_name))
				move_uploaded_file($f_name, "tables_attrs/mods/mods_id_".$modsid."/images/".$_FILES['mods_box_picture']['name']);
			$modsboxpic = "tables_attrs/mods/mods_id_".$modsid."/images/".$_FILES['mods_box_picture']['name'];
		}
		else
			$modsboxpic = $_SESSION['oldModsBoxPic'];
		
		unset($_SESSION['oldModsCarPic']);
		unset($_SESSION['oldModsBoxPic']);
		unset($_SESSION['oldModsDownload']);
		
		// edit Mods
		$m1 = new Mods();
		$m1->setModsId($modsid);
		$m1->setModsTitle($modstitle);
		$m1->setModsDesc($modsdescription);
		$m1->setModsCarPic($modscarpic);
		$m1->setModsBoxPic($modsboxpic);
		$m1->setModsDownload($modsdownload);
		$m1->setModsActive($modsactive);
		$db->updateMods($m1);
		if ($videoflag==1)
			$db->updateVideosQuery($modsvideoid, $modsvideo);
		if ($videoflag==0)
			$db->addVideo($modsvideo, "mods", $modsid);
		
		$db = null;
		
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
?>
