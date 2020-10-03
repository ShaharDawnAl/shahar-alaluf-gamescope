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
	
	if (!isset($_POST['confirmprofileedit']))
	{
		header("Location: index.php");
	}
	
	if (isset($_POST['chgFName']) && isset($_POST['chgLName']) && isset($_POST['chgEmail']) && isset($_POST['chgUName']))
	{
		if ((empty($_POST['chgPasswd']) && !empty($_POST['chgRePasswd'])) || (!empty($_POST['chgPasswd']) && empty($_POST['chgRePasswd'])))
		{
			echo '<script> alert("Both password fields must be entered!"); </script>';
			die ();
		}
		if (!empty($_POST['chgPasswd']) && !empty($_POST['chgRePasswd']))
		{
				$db = new dbClass();
				$errArray=array();
				$u = new Users();
				$u->setUserId($db->getUserByUserName($_SESSION['username']));
				$u = $db->getUserById($u->getUserId());
				
				$fname = $_POST['chgFName'];
				$lname = $_POST['chgLName'];
				$email = $_POST['chgEmail'];
				$username = $_POST['chgUName'];
				$password = $_POST['chgPasswd'];
				$reenterpassword = $_POST['chgRePasswd'];
				checkFName($fname,$errArray);
				checkLName($lname,$errArray);
				checkEmail($email,$errArray);
				checkUName($username,$errArray);
				checkPassword($password, $reenterpassword, $errArray);
				if ($email!=$u->getUserEmail())
					$db->checkEmailExists($email, $errArray);
				if ($username!=$u->getUserName())
					$db->checkUsernameExists($username, $errArray);
				$u = null;
				
				if(empty($errArray)) //success
				{
					// edit existing user with password
					$u1 = new Users();
					$u1->setUserId($db->getUserByUserName($_SESSION['username']));
					$u1->setUserFName($_POST['chgFName']);
					$u1->setUserLName($_POST['chgLName']);
					$u1->setUserEmail($_POST['chgEmail']);
					$u1->setUserName($_POST['chgUName']);
					$u1->setUserPassword($_POST['chgPasswd']);
					$u1->setUserAdmin($_SESSION['useradmin']);
					if (is_uploaded_file($_FILES['chgAvatar']['tmp_name']))
					{
						$f_name = $_FILES['chgAvatar']['tmp_name'];
						if (!file_exists("images/users/"))
							mkdir("images/users/");
						if (!file_exists("images/users/user_id_".$u1->getUserId()))
							mkdir("images/users/user_id_".$u1->getUserId());
						if (file_exists($f_name))
							move_uploaded_file($f_name, "images/users/user_id_".$u1->getUserId()."/".$_FILES['chgAvatar']['name']);
						$avatar = "images/users/user_id_".$u1->getUserId()."/".$_FILES['chgAvatar']['name'];
						$u1->setUserAvatar($avatar);
					}
					else
					{
						$avatar = $_SESSION['oldAvatar'];
						unset($_SESSION['oldAvatar']);
						$u1->setUserAvatar($avatar);
					}
					$db->updateUser_withEncr($u1);
					$db = null;
					$_SESSION['username'] = $username;
					$_SESSION['password'] = $password;
					echo("<script>alert('Profile successfully edited!')</script>");
					echo("<script>window.location = 'index.php';</script>");
				}
				else //failure
				{
					$db = null;
					echo '<script> alert("Profile editing errors:\n\n';
					foreach($errArray as $err)
					{
						echo $err.'\n';
					}
					echo '")</script>';
					echo("<script>window.location = 'editprofile.php';</script>");
			}
		}
		if (empty($_POST['chgPasswd']) && empty($_POST['chgRePasswd']))
		{
			$db = new dbClass();
			$errArray=array();
			$u = new Users();
			$u->setUserId($db->getUserByUserName($_SESSION['username']));
			$u = $db->getUserById($u->getUserId());
					
			$fname = $_POST['chgFName'];
			$lname = $_POST['chgLName'];
			$email = $_POST['chgEmail'];
			$username = $_POST['chgUName'];
			checkFName($fname,$errArray);
			checkLName($lname,$errArray);
			checkEmail($email,$errArray);
			checkUName($username,$errArray);
			if ($email!=$u->getUserEmail())
				$db->checkEmailExists($email, $errArray);
			if ($username!=$u->getUserName())
				$db->checkUsernameExists($username, $errArray);
			$u = null;
				
			if(empty($errArray)) //success
			{
				// edit existing user without password
				$u1 = new Users();
				$u1->setUserId($db->getUserByUserName($_SESSION['username']));
				$u1->setUserFName($_POST['chgFName']);
				$u1->setUserLName($_POST['chgLName']);
				$u1->setUserEmail($_POST['chgEmail']);
				$u1->setUserName($_POST['chgUName']);
				$u1->setUserAdmin($_SESSION['useradmin']);
				if (is_uploaded_file($_FILES['chgAvatar']['tmp_name']))
				{
					$f_name = $_FILES['chgAvatar']['tmp_name'];
					if (!file_exists("images/users/"))
						mkdir("images/users/");
					if (!file_exists("images/users/user_id_".$u1->getUserId()))
						mkdir("images/users/user_id_".$u1->getUserId());
					if (file_exists($f_name))
						move_uploaded_file($f_name, "images/users/user_id_".$u1->getUserId()."/".$_FILES['chgAvatar']['name']);
					$avatar = "images/users/user_id_".$u1->getUserId()."/".$_FILES['chgAvatar']['name'];
					$u1->setUserAvatar($avatar);
				}
				else
				{
					$avatar = $_SESSION['oldAvatar'];
					unset($_SESSION['oldAvatar']);
					$u1->setUserAvatar($avatar);
				}
				$db->updateUser_withoutEncr($u1);
				$db = null;
				$_SESSION['username'] = $username;
				echo("<script>alert('Profile successfully edited!')</script>");
				echo("<script>window.location = 'index.php';</script>");
			}
			else //failure
			{
				$db = null;
				echo '<script> alert("Profile editing errors:\n\n';
				foreach($errArray as $err)
				{
					echo $err.'\n';
				}
				echo '")</script>';
				echo("<script>window.location = 'editprofile.php';</script>");
			}
		}
	}
?>
