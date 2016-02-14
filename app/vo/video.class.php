<?php

class Video
{
	private $id;
	private $userid;
	private $sourceId;
	private $added;
	private $category;
	private $rate;
	private $views;
	private $type;
	private $feed;

	public function getId()
	{
	    return $this->id;
	}

	public function setId($id)
	{
	    $this->id = $id;
	}

	public function getUserid()
	{
	    return $this->userid;
	}

	public function setUserid($userid)
	{
	    $this->userid = $userid;
	}

	public function getSourceId()
	{
	    return $this->sourceId;
	}

	public function setSourceId($sourceId)
	{
	    $this->sourceId = $sourceId;
	}

	public function getAdded()
	{
	    return $this->added;
	}

	public function setAdded($added = null)
	{
		if ($added == null)
			$added = Date::getNow();
	    $this->added = $added;
	}

	public function getCategory()
	{
	    return $this->category;
	}

	public function setCategory($category)
	{
	    $this->category = $category;
	}

	public function getRate()
	{
	    return $this->rate;
	}

	public function setRate($rate)
	{
	    $this->rate = $rate;
	}

	public function getViews()
	{
	    return $this->views;
	}

	public function setViews($views)
	{
	    $this->views = $views;
	}

	public function getType()
	{
	    return $this->type;
	}

	public function setType($type)
	{
	    $this->type = $type;
	}

	public function getFeed()
	{
	    return $this->feed;
	}

	public function setFeed($feed)
	{
	    $this->feed = $feed;
	}
}

?>