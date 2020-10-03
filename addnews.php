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
	
	//check if not admin, head to home page
	if (!$_SESSION['useradmin'])
	{
		header("Location: index.php");
	}
	
	if(empty($_POST))
		header("Location: index.php");
	
	//create news if button clicked
	if (isset($_POST['confirmnewscreate']))
	{											
		$db = new dbClass();
		$newsuser = $db->getUserByUserName($_POST['newsuser']);
		$newstitle = $_POST['newsTitle'];
		$newsdescription = $_POST['newsDescription'];
		if (isset($_POST['newsVideo']))
		{
			if (!empty($_POST['newsVideo']))
				$newsvideo = $_POST['newsVideo'];
			else
				$newsvideo = "";
		}
		
		if (isset($_FILES['news_carousel_picture']['tmp_name']))
		{
			$f_name = $_FILES['news_carousel_picture']['tmp_name'];
			if (!file_exists("tables_attrs/news/news_id_".$db->getNextNewsAI()))
				mkdir("tables_attrs/news/news_id_".$db->getNextNewsAI());
			if (!file_exists("tables_attrs/news/news_id_".$db->getNextNewsAI()."/images/"))
				mkdir("tables_attrs/news/news_id_".$db->getNextNewsAI()."/images/");
			if (file_exists($f_name))
				move_uploaded_file($f_name, "tables_attrs/news/news_id_".$db->getNextNewsAI()."/images/".$_FILES['news_carousel_picture']['name']);
		}
		if (isset($_FILES['news_box_picture']['tmp_name']))
		{
			$f_name = $_FILES['news_box_picture']['tmp_name'];
			if (!file_exists("tables_attrs/news/news_id_".$db->getNextNewsAI()."/images/"))
				mkdir("tables_attrs/news/news_id_".$db->getNextNewsAI()."/images/");
			if (file_exists($f_name))
				move_uploaded_file($f_name, "tables_attrs/news/news_id_".$db->getNextNewsAI()."/images/".$_FILES['news_box_picture']['name']);
		}
		
		$newscarpic = "tables_attrs/news/news_id_".$db->getNextNewsAI()."/images/".$_FILES['news_carousel_picture']['name'];
		$newsboxpic = "tables_attrs/news/news_id_".$db->getNextNewsAI()."/images/".$_FILES['news_box_picture']['name'];
		
		// create news
		$n1 = new News();
		$n1->setNewsTitle($newstitle);
		$n1->setNewsDesc($newsdescription);
		$n1->setNewsUserId($newsuser);
		$n1->setNewsCarPic($newscarpic);
		$n1->setNewsBoxPic($newsboxpic);
		$newsid = $db->getNextNewsAI();
		$db->createNews($n1);
        if ($newsvideo != "") {
            if(strpos($newsvideo, 'watch?v=') !== false){
                $newsvideo = str_replace('watch?v=', 'embed/', $newsvideo);
                $db->addVideo($newsvideo, 'news', $newsid);
            } else {
                $db->addVideo($newsvideo, 'news', $newsid);
            }
        }
		$db = null;
		
		header("Location: adminmanagment.php");
	}	
?>
