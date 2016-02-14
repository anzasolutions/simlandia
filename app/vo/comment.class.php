<?php

class Comment
{
	private $id;
	private $content;
	private $type;
	private $typeId;
	private $date;
	private $userId;
	private $voteUp;
	private $voteDown;
	private $spam;
	
//	/**
//	 * @EntityCollection
//	 */
//	private $users;
//	
//	/**
//	 * @EntityObject
//	 */
//	private $user;

	public function getId()
	{
	    return $this->id;
	}

	public function setId($id)
	{
	    $this->id = $id;
	}

	public function getContent()
	{
	    return $this->content;
	}

	public function setContent($content)
	{
	    $this->content = $content;
	}

	public function getType()
	{
	    return $this->type;
	}

	public function setType($type)
	{
	    $this->type = $type;
	}

	public function getTypeId()
	{
	    return $this->typeId;
	}

	public function setTypeId($typeId)
	{
	    $this->typeId = $typeId;
	}

	public function getDate()
	{
	    return $this->date;
	}

	public function setDate($date = null)
	{
		if ($date == null)
			$date = Date::getNow();
	    $this->date = $date;
	}

//	public function getUserId()
//	{
//	    return $this->user->userId;
//	}
//
//	public function setUserId($userId)
//	{
//	    $this->user->userId = $userId;
//	}

	public function getUserId()
	{
	    return $this->userId;
	}

	public function setUserId($userId)
	{
	    $this->userId = $userId;
	}

	public function getVoteUp()
	{
	    return $this->voteUp;
	}

	public function setVoteUp($voteUp)
	{
	    $this->voteUp = $voteUp;
	}

	public function getVoteDown()
	{
	    return $this->voteDown;
	}

	public function setVoteDown($voteDown)
	{
	    $this->voteDown = $voteDown;
	}

	public function getSpam()
	{
	    return $this->spam;
	}

	public function setSpam($spam)
	{
	    $this->spam = $spam;
	}
}

?>