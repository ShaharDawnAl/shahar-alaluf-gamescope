<?php
class Comments_News extends  Comments
{
	protected $comment_id;
	protected $news_id;
	
	public function getCommentId()
	{
		return $this->comment_id;
	}
	
	public function setCommentId($commentid)
	{
		$this->comment_id = $commentid;
	}
	
	public function getCommentsNewsId()
	{
		return $this->news_id;
	}
	
	public function setCommentsNewsId($newsid)
	{
		$this->news_id = $newsid;
	}
	
}
?>