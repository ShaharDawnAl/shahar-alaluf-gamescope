<?php
class Videos_Codes extends  Videos
{
	protected $videos_id;
	protected $codes_id;
	
	public function getVideosId()
	{
		return $this->videos_id;
	}
	
	public function setVideosId($videosid)
	{
		$this->videos_id = $videosid;
	}
	
	public function getVideosCodesId()
	{
		return $this->codes_id;
	}
	
	public function setVideosCodesId($codesid)
	{
		$this->codes_id = $codesid;
	}
	
}
?>