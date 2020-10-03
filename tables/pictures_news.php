<?php
class Pictures_News extends  Pictures
{
	protected $pictures_id;
	protected $news_id;
	
	public function getPicturesId()
	{
		return $this->pictures_id;
	}
	
	public function setPicturesId($picturesid)
	{
		$this->pictures_id = $picturesid;
	}
	
	public function getPicturesNewsId()
	{
		return $this->news_id;
	}
	
	public function setPicturesNewsId($newsid)
	{
		$this->news_id = $newsid;
	}
	
}
?>