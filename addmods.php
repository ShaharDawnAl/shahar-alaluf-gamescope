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
	
	if(empty($_POST))
		header("Location: index.php");
	
	
	//create mod if button clicked
	if (isset($_POST['confirmmodcreate']))
	{											
		$db = new dbClass();
		if (isset($_POST['moduser']))
			$moduser = $db->getUserByUserName($_POST['moduser']);
		else
			$moduser = $db->getUserByUserName($_SESSION['username']);
		$modtitle = $_POST['modTitle'];
		$moddescription = $_POST['modDescription'];
		if (isset($_FILES['mod_pictures']))
		{
			$picturesArray = array();
			$modaddpiccount = count($_FILES['mod_pictures']['tmp_name']);
		}
		else
			$modaddpiccount = 0;
		if (isset($_POST['modActive']))
			$modactive = 1;
		else
			$modactive = 0;
		if (isset($_POST['modVideo']))
		{
			if (!empty($_POST['modVideo']))
				$modvideo = $_POST['modVideo'];
			else
				$modvideo = "";
		}
		
		for ($i=0; $i<$modaddpiccount;$i++)
		{
			if (isset($_FILES['mod_pictures']['tmp_name'][$i]))
			{
				$f_name = $_FILES['mod_pictures']['tmp_name'][$i];
				if (!file_exists("tables_attrs/mods/mods_id_".$db->getNextModAI()))
					mkdir("tables_attrs/mods/mods_id_".$db->getNextModAI());
				if (!file_exists("tables_attrs/mods/mods_id_".$db->getNextModAI()."/images/"))
					mkdir("tables_attrs/mods/mods_id_".$db->getNextModAI()."/images/");
				if (file_exists($f_name))
					move_uploaded_file($f_name, "tables_attrs/mods/mods_id_".$db->getNextModAI()."/images/".$_FILES['mod_pictures']['name'][$i]);
				$picturesArray[$i] = "tables_attrs/mods/mods_id_".$db->getNextModAI()."/images/".$_FILES['mod_pictures']['name'][$i];
			}
		}
		
		if (isset($_FILES['mod_carousel_picture']['tmp_name']))
		{
			$f_name = $_FILES['mod_carousel_picture']['tmp_name'];
			if (!file_exists("tables_attrs/mods/mods_id_".$db->getNextModAI()))
				mkdir("tables_attrs/mods/mods_id_".$db->getNextModAI());
			if (!file_exists("tables_attrs/mods/mods_id_".$db->getNextModAI()."/images/"))
				mkdir("tables_attrs/mods/mods_id_".$db->getNextModAI()."/images/");
			if (file_exists($f_name))
				move_uploaded_file($f_name, "tables_attrs/mods/mods_id_".$db->getNextModAI()."/images/".$_FILES['mod_carousel_picture']['name']);
		}
		if (isset($_FILES['mod_box_picture']['tmp_name']))
		{
			$f_name = $_FILES['mod_box_picture']['tmp_name'];
			if (!file_exists("tables_attrs/mods/mods_id_".$db->getNextModAI()."/images/"))
				mkdir("tables_attrs/mods/mods_id_".$db->getNextModAI()."/images/");
			if (file_exists($f_name))
				move_uploaded_file($f_name, "tables_attrs/mods/mods_id_".$db->getNextModAI()."/images/".$_FILES['mod_box_picture']['name']);
		}
		
		if (isset($_FILES['mod_download']['tmp_name']))
		{
			$f_name = $_FILES['mod_download']['tmp_name'];
			if (!file_exists("tables_attrs/mods/mods_id_".$db->getNextModAI()."/download/"))
				mkdir("tables_attrs/mods/mods_id_".$db->getNextModAI()."/download/");
			if (file_exists($f_name))
				move_uploaded_file($f_name, "tables_attrs/mods/mods_id_".$db->getNextModAI()."/download/".$_FILES['mod_download']['name']);
		}
		
		$modcarpic = "tables_attrs/mods/mods_id_".$db->getNextModAI()."/images/".$_FILES['mod_carousel_picture']['name'];
		$modboxpic = "tables_attrs/mods/mods_id_".$db->getNextModAI()."/images/".$_FILES['mod_box_picture']['name'];
		$moddownload = "tables_attrs/mods/mods_id_".$db->getNextModAI()."/download/".$_FILES['mod_download']['name'];
		
		// create mod
		$m1 = new Mods();
		$m1->setModsTitle($modtitle);
		$m1->setModsDesc($moddescription);
		$m1->setModsUserId($moduser);
		$m1->setModsCarPic($modcarpic);
		$m1->setModsBoxPic($modboxpic);
		$m1->setModsActive($modactive);
		$m1->setModsDownload($moddownload);
		$modid = $db->getNextModAI();
		$db->createMod($m1);
		if ($modvideo != "") {
            if(strpos($modvideo, 'watch?v=') !== false){
                $modvideo = str_replace('watch?v=', 'embed/', $modvideo);
                $db->addVideo($modvideo, 'mods', $modid);
            } else {
                $db->addVideo($modvideo, 'mods', $modid);
            }
        }
        
		if ($modaddpiccount > 0)
			$db->addPictures($picturesArray, 'mods', $modid);
		$db = null;
		
		echo("<script>alert('Mods successfully uploaded! Waiting to be approved...')</script>");
		echo("<script>window.location = 'index.php';</script>");
	}
?>
