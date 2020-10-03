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
	
	
	//create trainers if button clicked
	if (isset($_POST['confirmtrainerscreate']))
	{											
		$db = new dbClass();
		if (isset($_POST['trainersuser']))
			$trainersuser = $db->getUserByUserName($_POST['trainersuser']);
		else
			$trainersuser = $db->getUserByUserName($_SESSION['username']);
		$trainerstitle = $_POST['trainersTitle'];
		$trainersdescription = $_POST['trainersDescription'];
		if (is_uploaded_file($_FILES['trainers_pictures']['tmp_name'][0]))
		{
			$picturesArray = array();
			$trainersaddpiccount = count($_FILES['trainers_pictures']['tmp_name']);
		}
		else
			$trainersaddpiccount = 0;
		if (isset($_POST['trainersActive']))
			$trainersactive = 1;
		else
			$trainersactive = 0;
		if (isset($_POST['trainersVideo']))
		{
			if (!empty($_POST['trainersVideo']))
				$trainersvideo = $_POST['trainersVideo'];
			else
				$trainersvideo = "";
		}
		
		for ($i=0; $i<$trainersaddpiccount;$i++)
		{
			if (isset($_FILES['trainers_pictures']['tmp_name'][$i]))
			{
				$f_name = $_FILES['trainers_pictures']['tmp_name'][$i];
				if (!file_exists("tables_attrs/trainers/trainers_id_".$db->getNextTrainersAI()))
					mkdir("tables_attrs/trainers/trainers_id_".$db->getNextTrainersAI());
				if (!file_exists("tables_attrs/trainers/trainers_id_".$db->getNextTrainersAI()."/images/"))
					mkdir("tables_attrs/trainers/trainers_id_".$db->getNextTrainersAI()."/images/");
				if (file_exists($f_name))
					move_uploaded_file($f_name, "tables_attrs/trainers/trainers_id_".$db->getNextTrainersAI()."/images/".$_FILES['trainers_pictures']['name'][$i]);
				$picturesArray[$i] = "tables_attrs/trainers/trainers_id_".$db->getNextTrainersAI()."/images/".$_FILES['trainers_pictures']['name'][$i];
			}
		}
		
		if (isset($_FILES['trainers_carousel_picture']['tmp_name']))
		{
			$f_name = $_FILES['trainers_carousel_picture']['tmp_name'];
			if (!file_exists("tables_attrs/trainers/trainers_id_".$db->getNextTrainersAI()))
				mkdir("tables_attrs/trainers/trainers_id_".$db->getNextTrainersAI());
			if (!file_exists("tables_attrs/trainers/trainers_id_".$db->getNextTrainersAI()."/images/"))
				mkdir("tables_attrs/trainers/trainers_id_".$db->getNextTrainersAI()."/images/");
			if (file_exists($f_name))
				move_uploaded_file($f_name, "tables_attrs/trainers/trainers_id_".$db->getNextTrainersAI()."/images/".$_FILES['trainers_carousel_picture']['name']);
		}
		if (isset($_FILES['trainers_box_picture']['tmp_name']))
		{
			$f_name = $_FILES['trainers_box_picture']['tmp_name'];
			if (!file_exists("tables_attrs/trainers/trainers_id_".$db->getNextTrainersAI()."/images/"))
				mkdir("tables_attrs/trainers/trainers_id_".$db->getNextTrainersAI()."/images/");
			if (file_exists($f_name))
				move_uploaded_file($f_name, "tables_attrs/trainers/trainers_id_".$db->getNextTrainersAI()."/images/".$_FILES['trainers_box_picture']['name']);
		}
		
		if (isset($_FILES['trainers_download']['tmp_name']))
		{
			$f_name = $_FILES['trainers_download']['tmp_name'];
			if (!file_exists("tables_attrs/trainers/trainers_id_".$db->getNextTrainersAI()."/download/"))
				mkdir("tables_attrs/trainers/trainers_id_".$db->getNextTrainersAI()."/download/");
			if (file_exists($f_name))
				move_uploaded_file($f_name, "tables_attrs/trainers/trainers_id_".$db->getNextTrainersAI()."/download/".$_FILES['trainers_download']['name']);
		}
		
		$trainerscarpic = "tables_attrs/trainers/trainers_id_".$db->getNextTrainersAI()."/images/".$_FILES['trainers_carousel_picture']['name'];
		$trainersboxpic = "tables_attrs/trainers/trainers_id_".$db->getNextTrainersAI()."/images/".$_FILES['trainers_box_picture']['name'];
		$trainersdownload = "tables_attrs/trainers/trainers_id_".$db->getNextTrainersAI()."/download/".$_FILES['trainers_download']['name'];
		
		// create trainers
		$t1 = new Trainers();
		$t1->setTrainersTitle($trainerstitle);
		$t1->setTrainersDesc($trainersdescription);
		$t1->setTrainersUserId($trainersuser);
		$t1->setTrainersCarPic($trainerscarpic);
		$t1->setTrainersBoxPic($trainersboxpic);
		$t1->setTrainersActive($trainersactive);
		$t1->setTrainersDownload($trainersdownload);
		$trainersid = $db->getNextTrainersAI();
		$db->createTrainers($t1);
        if ($trainersvideo != "") {
            if(strpos($trainersvideo, 'watch?v=') !== false){
                $trainersvideo = str_replace('watch?v=', 'embed/', $trainersvideo);
                $db->addVideo($trainersvideo, 'trainers', $trainersid);
            } else {
                $db->addVideo($trainersvideo, 'trainers', $trainersid);
            }
        }
		if ($trainersaddpiccount > 0)
			$db->addPictures($picturesArray, 'trainers', $trainersid);
		$db = null;

		echo("<script>alert('Trainers successfully uploaded! Waiting to be approved...')</script>");
		echo("<script>window.location = 'index.php';</script>");
	}
?>
