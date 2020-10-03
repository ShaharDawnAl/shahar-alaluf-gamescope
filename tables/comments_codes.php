<?php
class Comments_Codes extends  Comments
{
	protected $comment_id;
	protected $codes_id;
	
	public function getCommentId()
	{
		return $this->comment_id;
	}
	
	public function setCommentId($commentid)
	{
		$this->comment_id = $commentid;
	}
	
	public function getCommentsCodesId()
	{
		return $this->codes_id;
	}
	
	public function setCommentsCodesId($codesid)
	{
		$this->codes_id = $codesid;
	}
	
}
?>