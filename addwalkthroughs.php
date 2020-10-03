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
	
	
	//create walkthroughs if button clicked
	if (isset($_POST['confirmwalkthroughscreate']))
	{											
		$db = new dbClass();
		if (isset($_POST['walkthroughsuser']))
			$walkthroughsuser = $db->getUserByUserName($_POST['walkthroughsuser']);
		else
			$walkthroughsuser = $db->getUserByUserName($_SESSION['username']);
		$walkthroughstitle = $_POST['walkthroughsTitle'];
		$walkthroughsdescription = $_POST['walkthroughsDescription'];
		if (is_uploaded_file($_FILES['walkthroughs_pictures']['tmp_name'][0]))
		{
			$picturesArray = array();
			$walkthroughsaddpiccount = count($_FILES['walkthroughs_pictures']['tmp_name']);
		}
		else
			$walkthroughsaddpiccount = 0;
		if (isset($_POST['walkthroughsActive']))
			$walkthroughsactive = 1;
		else
			$walkthroughsactive = 0;
		if (isset($_POST['walkthroughsVideo']))
		{
			if (!empty($_POST['walkthroughsVideo']))
				$walkthroughsvideo = $_POST['walkthroughsVideo'];
			else
				$walkthroughsvideo = "";
		}
		
		for ($i=0; $i<$walkthroughsaddpiccount;$i++)
		{
			if (isset($_FILES['walkthroughs_pictures']['tmp_name'][$i]))
			{
				$f_name = $_FILES['walkthroughs_pictures']['tmp_name'][$i];
				if (!file_exists("tables_attrs/walkthroughs/walkthroughs_id_".$db->getNextwalkthroughsAI()))
					mkdir("tables_attrs/walkthroughs/walkthroughs_id_".$db->getNextwalkthroughsAI());
				if (!file_exists("tables_attrs/walkthroughs/walkthroughs_id_".$db->getNextwalkthroughsAI()."/images/"))
					mkdir("tables_attrs/walkthroughs/walkthroughs_id_".$db->getNextwalkthroughsAI()."/images/");
				if (file_exists($f_name))
					move_uploaded_file($f_name, "tables_attrs/walkthroughs/walkthroughs_id_".$db->getNextwalkthroughsAI()."/images/".$_FILES['walkthroughs_pictures']['name'][$i]);
				$picturesArray[$i] = "tables_attrs/walkthroughs/walkthroughs_id_".$db->getNextwalkthroughsAI()."/images/".$_FILES['walkthroughs_pictures']['name'][$i];
			}
		}
		
		if (isset($_FILES['walkthroughs_carousel_picture']['tmp_name']))
		{
			$f_name = $_FILES['walkthroughs_carousel_picture']['tmp_name'];
			if (!file_exists("tables_attrs/walkthroughs/walkthroughs_id_".$db->getNextWalkthroughsAI()))
				mkdir("tables_attrs/walkthroughs/walkthroughs_id_".$db->getNextWalkthroughsAI());
			if (!file_exists("tables_attrs/walkthroughs/walkthroughs_id_".$db->getNextWalkthroughsAI()."/images/"))
				mkdir("tables_attrs/walkthroughs/walkthroughs_id_".$db->getNextWalkthroughsAI()."/images/");
			if (file_exists($f_name))
				move_uploaded_file($f_name, "tables_attrs/walkthroughs/walkthroughs_id_".$db->getNextWalkthroughsAI()."/images/".$_FILES['walkthroughs_carousel_picture']['name']);
		}
		if (isset($_FILES['walkthroughs_box_picture']['tmp_name']))
		{
			$f_name = $_FILES['walkthroughs_box_picture']['tmp_name'];
			if (!file_exists("tables_attrs/walkthroughs/walkthroughs_id_".$db->getNextWalkthroughsAI()."/images/"))
				mkdir("tables_attrs/walkthroughs/walkthroughs_id_".$db->getNextWalkthroughsAI()."/images/");
			if (file_exists($f_name))
				move_uploaded_file($f_name, "tables_attrs/walkthroughs/walkthroughs_id_".$db->getNextWalkthroughsAI()."/images/".$_FILES['walkthroughs_box_picture']['name']);
		}
		
		$walkthroughscarpic = "tables_attrs/walkthroughs/walkthroughs_id_".$db->getNextWalkthroughsAI()."/images/".$_FILES['walkthroughs_carousel_picture']['name'];
		$walkthroughsboxpic = "tables_attrs/walkthroughs/walkthroughs_id_".$db->getNextWalkthroughsAI()."/images/".$_FILES['walkthroughs_box_picture']['name'];
		
		// create walkthroughs
		$w1 = new Walkthroughs();
		$w1->setWalkthroughsTitle($walkthroughstitle);
		$w1->setWalkthroughsDesc($walkthroughsdescription);
		$w1->setWalkthroughsUserId($walkthroughsuser);
		$w1->setWalkthroughsCarPic($walkthroughscarpic);
		$w1->setWalkthroughsBoxPic($walkthroughsboxpic);
		$w1->setWalkthroughsActive($walkthroughsactive);
		$walkthroughsid = $db->getNextWalkthroughsAI();
		$db->createWalkthroughs($w1);
        if ($walkthroughsvideo != "") {
            if(strpos($walkthroughsvideo, 'watch?v=') !== false){
                $walkthroughsvideo = str_replace('watch?v=', 'embed/', $walkthroughsvideo);
                $db->addVideo($walkthroughsvideo, 'walkthroughs', $walkthroughsid);
            } else {
                $db->addVideo($walkthroughsvideo, 'walkthroughs', $walkthroughsid);
            }
        }
        
		if ($walkthroughsaddpiccount > 0)
			$db->addPictures($picturesArray, 'walkthroughs', $walkthroughsid);
		$db = null;
		
		echo("<script>alert('Walkthroughs successfully uploaded! Waiting to be approved...')</script>");
		echo("<script>window.location = 'index.php';</script>");
	}
?>
