<?php
class Comments_Mods extends  Comments
{
	protected $comment_id;
	protected $mods_id;
	
	public function getCommentId()
	{
		return $this->comment_id;
	}
	
	public function setCommentId($commentid)
	{
		$this->comment_id = $commentid;
	}
	
	public function getCommentsModsId()
	{
		return $this->mods_id;
	}
	
	public function setCommentsModsId($modsid)
	{
		$this->mods_id = $modsid;
	}
	
}
?>