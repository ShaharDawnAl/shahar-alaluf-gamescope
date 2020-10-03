<?php
class Walkthroughs
{
	protected $walkthroughs_id;
	protected $walkthroughs_title;
	protected $walkthroughs_desc;
	protected $walkthroughs_date;
	protected $walkthroughs_carpic;
	protected $walkthroughs_boxpic;
    protected $walkthroughs_active;
	protected $user_id;
	
	public function getWalkthroughsId()
	{
		return $this->walkthroughs_id;
	}
	
	public function setWalkthroughsId($walkthroughsid)
	{
		$this->walkthroughs_id = $walkthroughsid;
	}
	
	public function getWalkthroughsTitle()
	{
		return $this->walkthroughs_title;
	}
	
	public function setWalkthroughsTitle($walkthroughstitle)
	{
		$this->walkthroughs_title = $walkthroughstitle;
	}
	
	public function getWalkthroughsDesc()
	{
		return $this->walkthroughs_desc;
	}
	
	public function setWalkthroughsDesc($walkthroughsdesc)
	{
		$this->walkthroughs_desc = $walkthroughsdesc;
	}
	
	public function getWalkthroughsDate()
	{
		return $this->walkthroughs_date;
	}
	
	public function setWalkthroughsDate($walkthroughsdate)
	{
		$this->walkthroughs_date = $walkthroughsdate;
	}
	
	public function getWalkthroughsCarPic()
	{
		return $this->walkthroughs_carpic;
	}
	
	public function setWalkthroughsCarPic($walkthroughscarpic)
	{
		$this->walkthroughs_carpic = $walkthroughscarpic;
	}
	
	public function getWalkthroughsBoxPic()
	{
		return $this->walkthroughs_boxpic;
	}
	
	public function setWalkthroughsBoxPic($walkthroughsboxpic)
	{
		$this->walkthroughs_boxpic = $walkthroughsboxpic;
	}

    public function getWalkthroughsActive()
	{
		return $this->walkthroughs_active;
	}
	
	public function setWalkthroughsActive($walkthroughsactive)
	{
		$this->walkthroughs_active = $walkthroughsactive;
	}
	
	public function getWalkthroughsUserId()
	{
		return $this->user_id;
	}
	
	public function setWalkthroughsUserId($userid)
	{
		$this->user_id = $userid;
	}
	
}
?>