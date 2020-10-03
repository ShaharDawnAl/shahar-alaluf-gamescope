<?php
class Videos_News extends  Videos
{
	protected $videos_id;
	protected $news_id;
	
	public function getVideosId()
	{
		return $this->videos_id;
	}
	
	public function setVideosId($videosid)
	{
		$this->videos_id = $videosid;
	}
	
	public function getVideosNewsId()
	{
		return $this->news_id;
	}
	
	public function setVideosNewsId($newsid)
	{
		$this->news_id = $newsid;
	}
	
}
?>