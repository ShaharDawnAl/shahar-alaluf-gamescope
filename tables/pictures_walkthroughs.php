<?php
class Pictures_Walkthroughs extends  Pictures
{
	protected $pictures_id;
	protected $walkthroughs_id;
	
	public function getPicturesId()
	{
		return $this->pictures_id;
	}
	
	public function setPicturesId($picturesid)
	{
		$this->pictures_id = $picturesid;
	}
	
	public function getPicturesWalkthroughsId()
	{
		return $this->walkthroughs_id;
	}
	
	public function setPicturesWalkthroughsId($walkthroughsid)
	{
		$this->walkthroughs_id = $walkthroughsid;
	}
	
}
?>