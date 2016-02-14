<?php

/**
 * Base Video Service type class.
 * @author anza
 * @version 16-08-2011
 */
abstract class AbstractVS
{
	protected $id;
	protected $url;
	protected $xml;
	protected $feed;
	
	public function __construct($url)
	{
		$this->url = $url;
		$this->requestFeed();
	}
	
	protected abstract function requestFeed();
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getFeed()
	{
		return $this->feed;
	}
}

?>