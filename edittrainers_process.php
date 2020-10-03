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
	require_once "tables/trainers.php";
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
	$ttest = new Trainers();
	$ttest = $db->getTrainersByTrainersId($_SESSION['trainersId']);
	
	//check if not admin or created by current user, head to home page
	if (!$_SESSION['useradmin'] && $db->getUserByUserName($_SESSION['username'])!=$ttest->getTrainersUserId())
	{
		$db = null;
		$ttest = null;
		header("Location: index.php");
	}
	$ttest = null;
	
	if(empty($_POST))
		header("Location: index.php");
	
	//edit trainers if button clicked
	if (isset($_POST['confirmtrainersedit']))
	{							
		$trainersid = $_SESSION['trainersId'];
		unset($_SESSION['trainersId']);
		$trainerstitle = $_POST['trainersTitle'];
		$trainersdescription = $_POST['trainersDescription'];
		if (!empty($_POST['trainersVideo']))
		{
			$trainersvideo = $_POST['trainersVideo'];
			if (isset($_SESSION['videoId']))
			{
				$trainersvideoid = $_SESSION['videoId'];
				$videoflag = 1;
				unset($_SESSION['videoId']);
			}
			else
				$videoflag = 0;
		}
		
		if (is_uploaded_file($_FILES['trainers_pictures']['tmp_name'][0]))
		{
			$picturesArray = array();
			$trainersaddpiccount = count($_FILES['trainers_pictures']['tmp_name']);
			$db->deletePictures("trainers", $trainersid);
		}
		
		else
			$trainersaddpiccount = 0;
		if (isset($_POST['trainersActive']))
			$trainersactive = 1;
		else
			$trainersactive = 0;

		
		for ($i=0; $i<$trainersaddpiccount;$i++)
		{
			if (isset($_FILES['trainers_pictures']['tmp_name'][$i]))
			{
				$f_name = $_FILES['trainers_pictures']['tmp_name'][$i];
				if (!file_exists("tables_attrs/trainers/trainers_id_".$trainersid))
					mkdir("tables_attrs/trainers/trainers_id_".$trainersid);
				if (!file_exists("tables_attrs/trainers/trainers_id_".$trainersid."/images/"))
					mkdir("tables_attrs/trainers/trainers_id_".$trainersid."/images/");
				if (file_exists($f_name))
					move_uploaded_file($f_name, "tables_attrs/trainers/trainers_id_".$trainersid."/images/".$_FILES['trainers_pictures']['name'][$i]);
				$picturesArray[$i] = "tables_attrs/trainers/trainers_id_".$trainersid."/images/".$_FILES['trainers_pictures']['name'][$i];
			}
		}
		if ($trainersaddpiccount>0)
		{
			$db->deletePictures("trainers", $trainersid);
			$db->addPictures($picturesArray, 'trainers', $trainersid);
		}
		
		if (is_uploaded_file($_FILES['trainers_download']['tmp_name']))
		{
			$f_name = $_FILES['trainers_download']['tmp_name'];
			if (!file_exists("tables_attrs/trainers/trainers_id_".$trainersid))
				mkdir("tables_attrs/trainers/trainers_id_".$trainersid);
			if (!file_exists("tables_attrs/trainers/trainers_id_".$trainersid."/download/"))
				mkdir("tables_attrs/trainers/trainers_id_".$trainersid."/download/");
			if (file_exists($f_name))
				move_uploaded_file($f_name, "tables_attrs/trainers/trainers_id_".$trainersid."/download/".$_FILES['trainers_download']['name']);
			$trainersdownload = "tables_attrs/trainers/trainers_id_".$trainersid."/download/".$_FILES['trainers_download']['name'];
		}
		else
			$trainersdownload = $_SESSION['oldTrainersDownload'];
		
		
		if (is_uploaded_file($_FILES['trainers_carousel_picture']['tmp_name']))
		{
			$f_name = $_FILES['trainers_carousel_picture']['tmp_name'];
			if (!file_exists("tables_attrs/trainers/trainers_id_".$trainersid))
				mkdir("tables_attrs/trainers/trainers_id_".$trainersid);
			if (!file_exists("tables_attrs/trainers/trainers_id_".$trainersid."/images/"))
				mkdir("tables_attrs/trainers/trainers_id_".$trainersid."/images/");
			if (file_exists($f_name))
				move_uploaded_file($f_name, "tables_attrs/trainers/trainers_id_".$trainersid."/images/".$_FILES['trainers_carousel_picture']['name']);
			$trainerscarpic = "tables_attrs/trainers/trainers_id_".$trainersid."/images/".$_FILES['trainers_carousel_picture']['name'];
		}
		else
			$trainerscarpic = $_SESSION['oldTrainersCarPic'];
		
		if (is_uploaded_file($_FILES['trainers_box_picture']['tmp_name']))
		{
			$f_name = $_FILES['trainers_box_picture']['tmp_name'];
			if (!file_exists("tables_attrs/trainers/trainers_id_".$trainersid."/images/"))
				mkdir("tables_attrs/trainers/trainers_id_".$trainersid."/images/");
			if (file_exists($f_name))
				move_uploaded_file($f_name, "tables_attrs/trainers/trainers_id_".$trainersid."/images/".$_FILES['trainers_box_picture']['name']);
			$trainersboxpic = "tables_attrs/trainers/trainers_id_".$trainersid."/images/".$_FILES['trainers_box_picture']['name'];
		}
		else
			$trainersboxpic = $_SESSION['oldTrainersBoxPic'];
		
		unset($_SESSION['oldTrainersCarPic']);
		unset($_SESSION['oldTrainersBoxPic']);
		unset($_SESSION['oldTrainersDownload']);
		
		// edit trainers
		$t1 = new trainers();
		$t1->setTrainersId($trainersid);
		$t1->setTrainersTitle($trainerstitle);
		$t1->setTrainersDesc($trainersdescription);
		$t1->setTrainersCarPic($trainerscarpic);
		$t1->setTrainersBoxPic($trainersboxpic);
		$t1->setTrainersDownload($trainersdownload);
		$t1->setTrainersActive($trainersactive);
		$db->updateTrainers($t1);
		if ($videoflag==1)
			$db->updateVideosQuery($trainersvideoid, $trainersvideo);
		if ($videoflag==0)
			$db->addVideo($trainersvideo, "trainers", $trainersid);
		
		$db = null;
		
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
?>
