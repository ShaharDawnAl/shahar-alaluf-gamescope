<?php
class Comments_Walkthroughs extends  Comments
{
	protected $comment_id;
	protected $walkthroughs_id;
	
	public function getCommentId()
	{
		return $this->comment_id;
	}
	
	public function setCommentId($commentid)
	{
		$this->comment_id = $commentid;
	}
	
	public function getCommentsWalkthroughsId()
	{
		return $this->walkthroughs_id;
	}
	
	public function setCommentsWalkthroughsId($walkthroughsid)
	{
		$this->walkthroughs_id = $walkthroughsid;
	}
	
}
?>