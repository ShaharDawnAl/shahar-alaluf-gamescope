<?php
class Comments_Trainers extends  Comments
{
	protected $comment_id;
	protected $trainers_id;
	
	public function getCommentId()
	{
		return $this->comment_id;
	}
	
	public function setCommentId($commentid)
	{
		$this->comment_id = $commentid;
	}
	
	public function getCommentsTrainersId()
	{
		return $this->trainers_id;
	}
	
	public function setCommentsTrainersId($trainersid)
	{
		$this->trainers_id = $trainersid;
	}
	
}
?>