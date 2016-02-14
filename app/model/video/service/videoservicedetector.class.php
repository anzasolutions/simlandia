<?php

/**
 * Facade of important video service data.
 * @author anza
 * @version 18-08-2011
 */
class VideoServiceDetector
{
	private $url;
	private $type;
	private $service;
	
	public function __construct($url)
	{
		$this->url = $url;
		$this->detect($url);
	}
	
	public function detect($url)
	{
		$host = parse_url($this->url, PHP_URL_HOST);
		$videoTypes = DAOFactory::getVideoTypeDAO()->findAll();
		foreach ($videoTypes as $type)
		{
			if (stristr($host, $type->getName()))
			{
				$this->type = $type;
				$this->initializeService();
				break;
			}
		}
		
		// what if video is not of recognizable type?
		// exception?
	}
	
	private function initializeService()
	{
		$serviceName = $this->type->getName() . 'VS';
		$this->service = new $serviceName($this->url);
	}
	
	public function getId()
	{
		return $this->service->getId();
	}
	
	public function getType()
	{
		return $this->type;
	}
	
	public function getFeed()
	{
		return $this->service->getFeed();
	}
}

?>