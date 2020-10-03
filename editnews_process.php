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
	
	//edit news if button clicked
	if (isset($_POST['confirmnewsedit']))
	{							
		$db = new dbClass();
		$newsid = $_SESSION['newsId'];
		unset($_SESSION['newsid']);
		$newstitle = $_POST['newsTitle'];
		$newsdescription = $_POST['newsDescription'];
		if (!empty($_POST['newsVideo']))
		{
			$newsvideo = $_POST['newsVideo'];
			if (isset($_SESSION['videoId']))
			{
				$newsvideoid = $_SESSION['videoId'];
				$videoflag = 1;
				unset($_SESSION['videoId']);
			}
			else
				$videoflag = 0;
		}
		if (is_uploaded_file($_FILES['news_carousel_picture']['tmp_name']))
		{
			$f_name = $_FILES['news_carousel_picture']['tmp_name'];
			if (!file_exists("tables_attrs/news/news_id_".$newsid))
				mkdir("tables_attrs/news/news_id_".$newsid);
			if (!file_exists("tables_attrs/news/news_id_".$newsid."/images/"))
				mkdir("tables_attrs/news/news_id_".$newsid."/images/");
			if (file_exists($f_name))
				move_uploaded_file($f_name, "tables_attrs/news/news_id_".$newsid."/images/".$_FILES['news_carousel_picture']['name']);
			$newscarpic = "tables_attrs/news/news_id_".$newsid."/images/".$_FILES['news_carousel_picture']['name'];
		}
		else
			$newscarpic = $_SESSION['oldNewsCarPic'];
		
		if (is_uploaded_file($_FILES['news_box_picture']['tmp_name']))
		{
			$f_name = $_FILES['news_box_picture']['tmp_name'];
			if (!file_exists("tables_attrs/news/news_id_".$newsid."/images/"))
				mkdir("tables_attrs/news/news_id_".$newsid."/images/");
			if (file_exists($f_name))
				move_uploaded_file($f_name, "tables_attrs/news/news_id_".$newsid."/images/".$_FILES['news_box_picture']['name']);
			$newsboxpic = "tables_attrs/news/news_id_".$newsid."/images/".$_FILES['news_box_picture']['name'];
		}
		else
			$newsboxpic = $_SESSION['oldNewsBoxPic'];
		
		unset($_SESSION['oldNewsCarPic']);
		unset($_SESSION['oldNewsBoxPic']);
		
		// edit news
		$n1 = new News();
		$n1->setNewsId($newsid);
		$n1->setNewsTitle($newstitle);
		$n1->setNewsDesc($newsdescription);
		$n1->setNewsCarPic($newscarpic);
		$n1->setNewsBoxPic($newsboxpic);
		$db->updateNews($n1);
		if ($videoflag==1)
			$db->updateVideosQuery($newsvideoid, $newsvideo);
		if ($videoflag==0)
			$db->addVideo($newsvideo, "news", $newsid);
		
		$db = null;
		
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}	
?>
