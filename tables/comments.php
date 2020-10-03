<?php
class Comments 
{
	protected $comment_id;
	protected $comment_text;
	protected $comment_pdate;
	protected $user_id;
	
	public function getCommentId()
	{
		return $this->comment_id;
	}
	
	public function setCommentId($commentid)
	{
		$this->comment_id = $commentid;
	}
	
	public function getCommentsText()
	{
		return $this->comment_text;
	}
	
	public function setCommentsText($commenttext)
	{
		$this->comment_text = $commenttext;
	}
	
	public function getCommentsPDate()
	{
		return $this->comment_pdate;
	}
	
	public function setCommentsPDate($commentpdate)
	{
		$this->comment_pdate = $commentpdate;
	}
	
	public function getCommentsUserId()
	{
		return $this->user_id;
	}
	
	public function setCommentsUserId($userid)
	{
		$this->user_id = $userid;
	}
	
}
?>