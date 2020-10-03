<?php
class Users
{
	protected $user_id;
	protected $user_email;
	protected $user_password;
	protected $user_username;
	protected $user_fname;
	protected $user_lname;
	protected $user_avatar;
	protected $user_admin;
	
	public function getUserId()
	{
		return $this->user_id;
	}
	
	public function setUserId($userid)
	{
		$this->user_id = $userid;
	}
	
	public function getUserEmail()
	{
		return $this->user_email;
	}
	
	public function setUserEmail($useremail)
	{
		$this->user_email = $useremail;
	}
	
	public function getUserPassword()
	{
		return $this->user_password;
	}
	
	public function setUserPassword($userpassword)
	{
		$this->user_password = $userpassword;
	}
	
	public function getUserName()
	{
		return $this->user_username;
	}
	
	public function setUserName($username)
	{
		$this->user_username = $username;
	}
	
	public function getUserFName()
	{
		return $this->user_fname;
	}
	
	public function setUserFName($userfname)
	{
		$this->user_fname = $userfname;
	}
	
	public function getUserLName()
	{
		return $this->user_lname;
	}
	
	public function setUserLName($userlname)
	{
		$this->user_lname = $userlname;
	}
	
	public function getUserAvatar()
	{
		return $this->user_avatar;
	}
	
	public function setUserAvatar($useravatar)
	{
		$this->user_avatar = $useravatar;
	}
	
	public function getUserAdmin()
	{
		return $this->user_admin;
	}
	
	public function setUserAdmin($useradmin)
	{
		$this->user_admin = $useradmin;
	}
}
?>