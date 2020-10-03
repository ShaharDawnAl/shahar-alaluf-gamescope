<?php

//Registeration input Check
//Function which validates a first name
function checkFName($fname,&$errArray)
{
	if(!empty($fname))
	{
		if(!preg_match("/^[a-zA-Z]{1,25}$/",$fname))
		{
			$errArray[]="First name can contain 1-25 lowercase/uppercase letters only";
		}
	}
	else
	{
		$errArray[]="First name field can't be empty";
	}
}

//Function which validates a first name
function checkLName($lname,&$errArray)
{
	if(!empty($lname))
	{
		if(!preg_match("/^[a-zA-Z]{1,25}$/",$lname))
		{
			$errArray[]="Last name can contain 1-25 lowercase/uppercase letters only";
		}
	}
	else
	{
		$errArray[]="Last name field can't be empty";
	}
}

//Function which validates an email address
function checkEmail($email,&$errArray)
{
	if(!empty($email))
	{
		if(!filter_var($email,FILTER_VALIDATE_EMAIL))
		{
			$errArray[]="Wrong email format";
		}
	}
	else
	{
		$errArray[]="Email can't be empty";
	}
}

//Function which validates a username
function checkUName($uname,&$errArray)
{
	if(!empty($uname))
	{
		if(!preg_match("/^[a-zA-Z0-9]{5,11}$/",$uname))
		{
			$errArray[]="Username can contain 5-11 lowercase/uppercase letters and digits only";
		}
	}
	else
	{
		$errArray[]="Username field can't be empty";
	}
}

//Function which validates a password
function checkPassword($password, $reenterpassword, &$errArray)
{
	if(!empty($password) && !empty($reenterpassword))
	{
		if(!preg_match("/^[a-zA-Z0-9]{1,8}$/",$password))
		{
			$errArray[]="Password can contain 1-8 lowercase/uppercase letters and digits only";
		}
		if ($password!=$reenterpassword)
		{
			$errArray[]="Password and Re-Enter Password must match!";
		}
	}
	else
	{
		$errArray[]="Password can't be empty";
	}
}

//check is session is started
function is_session_started ()
{
	return function_exists ( 'session_status' ) ? ( PHP_SESSION_ACTIVE == session_status () ) : ( ! empty ( session_id () ) ); 
}

?>
