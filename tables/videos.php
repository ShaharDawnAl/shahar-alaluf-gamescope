<?php
class Videos
{
	protected $videos_id;
	protected $videos_link;
	
	public function getVideosId()
	{
		return $this->videos_id;
	}
	
	public function setVideosId($videosid)
	{
		$this->videos_id = $videosid;
	}
	
	public function getVideosLink()
	{
		return $this->videos_link;
	}
	
	public function setVideosLink($videoslink)
	{
		$this->videos_link = $videoslink;
	}
	
}
?>