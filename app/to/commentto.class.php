<?php

/**
 * Carries values for comment presentation in view.
 * @author anza
 * @version 13-08-2011
 */
class CommentTO extends AbstractTO
{
	private $comment;
	private $user;
	
	public function __construct(Comment $comment, array $users)
	{
		$this->comment = $comment;
		$this->user = $users[$comment->getUserId()];
	}

	public function getContent()
	{
	    return $this->comment->getContent();
	}

	public function getDate()
	{
	    return $this->comment->getDate();
	}

	public function getUserId()
	{
	    return $this->user->getId();
	}

	public function getName()
	{
	    return $this->user->getFirstname() . SPACE . $this->user->getLastname();
	}

	public function getLogin()
	{
	    return $this->user->getLogin();
	}

	public function getComment()
	{
	    return $this->comment;
	}

	public function getUser()
	{
	    return $this->user;
	}
}

?>