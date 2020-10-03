<?php
class Videos_Trainers extends  Videos
{
	protected $videos_id;
	protected $trainers_id;
	
	public function getVideosId()
	{
		return $this->videos_id;
	}
	
	public function setVideosId($videosid)
	{
		$this->videos_id = $videosid;
	}
	
	public function getVideosTrainersId()
	{
		return $this->trainers_id;
	}
	
	public function setVideosTrainersId($trainersid)
	{
		$this->trainers_id = $trainersid;
	}
	
}
?>