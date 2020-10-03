<?php
class Mods
{
	protected $mods_id;
	protected $mods_title;
	protected $mods_desc;
	protected $mods_date;
	protected $mods_carpic;
	protected $mods_boxpic;
    protected $mods_download;
	protected $mods_active;
	protected $user_id;
	
	public function getModsId()
	{
		return $this->mods_id;
	}
	
	public function setModsId($modsid)
	{
		$this->mods_id = $modsid;
	}
	
	public function getModsTitle()
	{
		return $this->mods_title;
	}
	
	public function setModsTitle($modstitle)
	{
		$this->mods_title = $modstitle;
	}
	
	public function getModsDesc()
	{
		return $this->mods_desc;
	}
	
	public function setModsDesc($modsdesc)
	{
		$this->mods_desc = $modsdesc;
	}
	
	public function getModsDate()
	{
		return $this->mods_date;
	}
	
	public function setModsDate($modsdate)
	{
		$this->mods_date = $modsdate;
	}
	
	public function getModsCarPic()
	{
		return $this->mods_carpic;
	}
	
	public function setModsCarPic($modscarpic)
	{
		$this->mods_carpic = $modscarpic;
	}
	
	public function getModsBoxPic()
	{
		return $this->mods_boxpic;
	}
	
	public function setModsBoxPic($modsboxpic)
	{
		$this->mods_boxpic = $modsboxpic;
	}

	public function getModsDownload()
	{
		return $this->mods_download;
	}
	
	public function setModsDownload($modsdownload)
	{
		$this->mods_download = $modsdownload;
	}
	
	public function getModsActive()
	{
		return $this->mods_active;
	}
	
	public function setModsActive($modsactive)
	{
		$this->mods_active = $modsactive;
	}
	
	public function getModsUserId()
	{
		return $this->user_id;
	}
	
	public function setModsUserId($userid)
	{
		$this->user_id = $userid;
	}
	
}
?>