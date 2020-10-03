<?php
class Videos_Mods extends  Videos
{
	protected $videos_id;
	protected $mods_id;
	
	public function getVideosId()
	{
		return $this->videos_id;
	}
	
	public function setVideosId($videosid)
	{
		$this->videos_id = $videosid;
	}
	
	public function getVideosModsId()
	{
		return $this->mods_id;
	}
	
	public function setVideosModsId($modsid)
	{
		$this->mods_id = $modsid;
	}
	
}
?>