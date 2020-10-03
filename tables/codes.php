<?php
class Codes
{
	protected $codes_id;
	protected $codes_title;
	protected $codes_desc;
	protected $codes_date;
	protected $codes_carpic;
	protected $codes_boxpic;
    protected $codes_active;
	protected $user_id;
	
	public function getCodesId()
	{
		return $this->codes_id;
	}
	
	public function setCodesId($codesid)
	{
		$this->codes_id = $codesid;
	}
	
	public function getCodesTitle()
	{
		return $this->codes_title;
	}
	
	public function setCodesTitle($codestitle)
	{
		$this->codes_title = $codestitle;
	}
	
	public function getCodesDesc()
	{
		return $this->codes_desc;
	}
	
	public function setCodesDesc($codesdesc)
	{
		$this->codes_desc = $codesdesc;
	}
	
	public function getCodesDate()
	{
		return $this->codes_date;
	}
	
	public function setCodesDate($codesdate)
	{
		$this->codes_date = $codesdate;
	}
	
	public function getCodesCarPic()
	{
		return $this->codes_carpic;
	}
	
	public function setCodesCarPic($codescarpic)
	{
		$this->codes_carpic = $codescarpic;
	}
	
	public function getCodesBoxPic()
	{
		return $this->codes_boxpic;
	}
	
	public function setCodesBoxPic($codesboxpic)
	{
		$this->codes_boxpic = $codesboxpic;
	}

	public function getCodesActive()
	{
		return $this->codes_active;
	}
	
	public function setCodesActive($codesactive)
	{
		$this->codes_active = $codesactive;
	}
    
	public function getCodesUserId()
	{
		return $this->user_id;
	}
	
	public function setCodesUserId($userid)
	{
		$this->user_id = $userid;
	}
	
}
?>