<?php
class News
{
	protected $news_id;
	protected $news_title;
	protected $news_desc;
	protected $news_date;
	protected $news_carpic;
	protected $news_boxpic;
	protected $user_id;
	
	public function getNewsId()
	{
		return $this->news_id;
	}
	
	public function setNewsId($newsid)
	{
		$this->news_id = $newsid;
	}
	
	public function getNewsTitle()
	{
		return $this->news_title;
	}
	
	public function setNewsTitle($newstitle)
	{
		$this->news_title = $newstitle;
	}
	
	public function getNewsDesc()
	{
		return $this->news_desc;
	}
	
	public function setNewsDesc($newsdesc)
	{
		$this->news_desc = $newsdesc;
	}
	
	public function getNewsDate()
	{
		return $this->news_date;
	}
	
	public function setNewsDate($newsdate)
	{
		$this->news_date = $newsdate;
	}
	
	public function getNewsCarPic()
	{
		return $this->news_carpic;
	}
	
	public function setNewsCarPic($newscarpic)
	{
		$this->news_carpic = $newscarpic;
	}
	
	public function getNewsBoxPic()
	{
		return $this->news_boxpic;
	}
	
	public function setNewsBoxPic($newsboxpic)
	{
		$this->news_boxpic = $newsboxpic;
	}

	
	public function getNewsUserId()
	{
		return $this->user_id;
	}
	
	public function setNewsUserId($userid)
	{
		$this->user_id = $userid;
	}
	
}
?>