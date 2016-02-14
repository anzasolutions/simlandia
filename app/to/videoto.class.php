<?php

class VideoTO extends AbstractTO
{
	private $title;
	private $description;
	private $length;
	private $video;
	private $user;
	private $thumbnail;
	private $type;
	
	public function __construct(Video $video, User $user)
	{
		$this->video = $video;
		$this->user = $user;
	}

	public function getTitle()
	{
	    return $this->title;
	}

	public function setTitle($title)
	{
	    $this->title = $title;
	}

	public function getDescription()
	{
	    return $this->description;
	}

	public function setDescription($description)
	{
	    $this->description = $description;
	}

	public function getLength()
	{
	    return $this->length;
	}

	public function setLength($length)
	{
	    $this->length = $length;
	}

	public function getDate()
	{
	    return $this->video->getAdded();
	}

	public function getSourceId()
	{
	    return $this->video->getSourceId();
	}
	
	public function getUsername()
	{
		return $this->user->getFirstname() . SPACE . $this->user->getLastname();
	}
	
	public function getLogin()
	{
		return $this->user->getLogin();
	}

	public function getThumbnail()
	{
	    return $this->thumbnail;
	}

	public function setThumbnail($thumbnail)
	{
	    $this->thumbnail = $thumbnail;
	}

	public function getId()
	{
	    return $this->video->getId();
	}

	public function getType()
	{
	    return $this->type;
	}

	public function setType($type)
	{
	    $this->type = $type;
	}
}

?>