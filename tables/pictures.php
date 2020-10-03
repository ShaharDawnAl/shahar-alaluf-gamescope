<?php
class Pictures
{
	protected $pictures_id;
	protected $pictures_link;
	
	public function getPicturesId()
	{
		return $this->pictures_id;
	}
	
	public function setPicturesId($picturesid)
	{
		$this->pictures_id = $picturesid;
	}
	
	public function getPicturesLink()
	{
		return $this->pictures_link;
	}
	
	public function setPicturesLink($pictureslink)
	{
		$this->pictures_link = $pictureslink;
	}
	
}
?>