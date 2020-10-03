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
	
	if(empty($_POST))
		header("Location: index.php");
	
	
	//create codes if button clicked
	if (isset($_POST['confirmcodescreate']))
	{											
		$db = new dbClass();
		if (isset($_POST['codesuser']))
			$codesuser = $db->getUserByUserName($_POST['codesuser']);
		else
			$codesuser = $db->getUserByUserName($_SESSION['username']);
		$codestitle = $_POST['codesTitle'];
		$codesdescription = $_POST['codesDescription'];

		if (isset($_POST['codesActive']))
			$codesactive = 1;
		else
			$codesactive = 0;
		if (isset($_POST['codesVideo']))
		{
			if (!empty($_POST['codesVideo']))
				$codesvideo = $_POST['codesVideo'];
			else
				$codesvideo = "";
		}
			
		if (isset($_FILES['codes_carousel_picture']['tmp_name']))
		{
			$f_name = $_FILES['codes_carousel_picture']['tmp_name'];
			if (!file_exists("tables_attrs/codess/codess_id_".$db->getNextCodesAI()))
				mkdir("tables_attrs/codes/codes_id_".$db->getNextCodesAI());
			if (!file_exists("tables_attrs/codes/codes_id_".$db->getNextCodesAI()."/images/"))
				mkdir("tables_attrs/codes/codes_id_".$db->getNextCodesAI()."/images/");
			if (file_exists($f_name))
				move_uploaded_file($f_name, "tables_attrs/codes/codes_id_".$db->getNextCodesAI()."/images/".$_FILES['codes_carousel_picture']['name']);
		}
		if (isset($_FILES['codes_box_picture']['tmp_name']))
		{
			$f_name = $_FILES['codes_box_picture']['tmp_name'];
			if (!file_exists("tables_attrs/codes/codes_id_".$db->getNextCodesAI()."/images/"))
				mkdir("tables_attrs/codes/codes_id_".$db->getNextCodesAI()."/images/");
			if (file_exists($f_name))
				move_uploaded_file($f_name, "tables_attrs/codes/codes_id_".$db->getNextCodesAI()."/images/".$_FILES['codes_box_picture']['name']);
		}
		
		$codescarpic = "tables_attrs/codes/codes_id_".$db->getNextCodesAI()."/images/".$_FILES['codes_carousel_picture']['name'];
		$codesboxpic = "tables_attrs/codes/codes_id_".$db->getNextCodesAI()."/images/".$_FILES['codes_box_picture']['name'];
		
		// create codes
		$c1 = new Codes();
		$c1->setCodesTitle($codestitle);
		$c1->setCodesDesc($codesdescription);
		$c1->setCodesUserId($codesuser);
		$c1->setCodesCarPic($codescarpic);
		$c1->setCodesBoxPic($codesboxpic);
		$c1->setCodesActive($codesactive);
		$codesid = $db->getNextCodesAI();
		$db->createCodes($c1);
        if ($codesvideo != "") {
            if(strpos($codesvideo, 'watch?v=') !== false){
                $codesvideo = str_replace('watch?v=', 'embed/', $codesvideo);
                $db->addVideo($codesvideo, 'codes', $codesid);
            } else {
                $db->addVideo($codesvideo, 'codes', $codesid);
            }
        }
		$db = null;
		
		echo("<script>alert('Codes successfully uploaded! Waiting to be approved...')</script>");
		echo("<script>window.location = 'index.php';</script>");
	}
?>
