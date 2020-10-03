<?php
class Pictures_Mods extends  Pictures
{
	protected $pictures_id;
	protected $mods_id;
	
	public function getPicturesId()
	{
		return $this->pictures_id;
	}
	
	public function setPicturesId($picturesid)
	{
		$this->pictures_id = $picturesid;
	}
	
	public function getPicturesModsId()
	{
		return $this->mods_id;
	}
	
	public function setPicturesModsId($modsid)
	{
		$this->mods_id = $modsid;
	}
	
}
?>