<?php
class Pictures_Codes extends  Pictures
{
	protected $pictures_id;
	protected $codes_id;
	
	public function getPicturesId()
	{
		return $this->pictures_id;
	}
	
	public function setPicturesId($picturesid)
	{
		$this->pictures_id = $picturesid;
	}
	
	public function getPicturesCodesId()
	{
		return $this->codes_id;
	}
	
	public function setPicturesCodesId($codesid)
	{
		$this->codes_id = $codesid;
	}
	
}
?>