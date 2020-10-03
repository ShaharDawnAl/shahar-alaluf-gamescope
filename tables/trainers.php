<?php
class Trainers
{
	protected $trainers_id;
	protected $trainers_title;
	protected $trainers_desc;
	protected $trainers_date;
	protected $trainers_carpic;
	protected $trainers_boxpic;
    protected $trainers_download;
	protected $trainers_active;
	protected $user_id;
	
	public function getTrainersId()
	{
		return $this->trainers_id;
	}
	
	public function setTrainersId($trainersid)
	{
		$this->trainers_id = $trainersid;
	}
	
	public function getTrainersTitle()
	{
		return $this->trainers_title;
	}
	
	public function setTrainersTitle($trainerstitle)
	{
		$this->trainers_title = $trainerstitle;
	}
	
	public function getTrainersDesc()
	{
		return $this->trainers_desc;
	}
	
	public function setTrainersDesc($trainersdesc)
	{
		$this->trainers_desc = $trainersdesc;
	}
	
	public function getTrainersDate()
	{
		return $this->trainers_date;
	}
	
	public function setTrainersDate($trainersdate)
	{
		$this->trainers_date = $trainersdate;
	}
	
	public function getTrainersCarPic()
	{
		return $this->trainers_carpic;
	}
	
	public function setTrainersCarPic($trainerscarpic)
	{
		$this->trainers_carpic = $trainerscarpic;
	}
	
	public function getTrainersBoxPic()
	{
		return $this->trainers_boxpic;
	}
	
	public function setTrainersBoxPic($trainersboxpic)
	{
		$this->trainers_boxpic = $trainersboxpic;
	}

	public function getTrainersDownload()
	{
		return $this->trainers_download;
	}
	
	public function setTrainersDownload($trainersdownload)
	{
		$this->trainers_download = $trainersdownload;
	}
	
	public function getTrainersActive()
	{
		return $this->trainers_active;
	}
	
	public function setTrainersActive($trainersactive)
	{
		$this->trainers_active = $trainersactive;
	}
	
	public function getTrainersUserId()
	{
		return $this->user_id;
	}
	
	public function setTrainersUserId($userid)
	{
		$this->user_id = $userid;
	}
	
}
?>