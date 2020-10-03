<?php
class Videos_Walkthroughs extends  Videos
{
	protected $videos_id;
	protected $walkthroughs_id;
	
	public function getVideosId()
	{
		return $this->videos_id;
	}
	
	public function setVideosId($videosid)
	{
		$this->videos_id = $videosid;
	}
	
	public function getVideosWalkthroughsId()
	{
		return $this->walkthroughs_id;
	}
	
	public function setVideosWalkthroughsId($walkthroughsid)
	{
		$this->walkthroughs_id = $walkthroughsid;
	}
	
}
?>