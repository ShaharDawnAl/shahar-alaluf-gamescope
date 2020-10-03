<?php
class Pictures_Trainers extends  Pictures
{
	protected $pictures_id;
	protected $trainers_id;
	
	public function getPicturesId()
	{
		return $this->pictures_id;
	}
	
	public function setPicturesId($picturesid)
	{
		$this->pictures_id = $picturesid;
	}
	
	public function getPicturesTrainersId()
	{
		return $this->trainers_id;
	}
	
	public function setPicturesTrainersId($trainersid)
	{
		$this->trainers_id = $trainersid;
	}
	
}
?>