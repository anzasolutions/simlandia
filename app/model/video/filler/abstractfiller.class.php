<?php

/**
 * Base class for all fillers.
 * @author anza
 * @version 18-08-2011
 */
abstract class AbstractFiller
{
	protected $video;
	protected $details;
	protected $user;
	protected $videoTO;
	
	public function __construct(Video $video)
	{
		$this->video = $video;
		$this->details = $this->getVideoDetails();
		$this->user = DAOFactory::getUserDAO()->findById($video->getUserId());
		$this->videoTO = new VideoTO($this->video, $this->user);
	}
	
	public function getVideoTO()
	{
		return $this->fillVideo();
	}
	
	protected abstract function fillVideo();
	
	protected function getVideoDetails()
	{
		$unserialized = Serializer::unserialize($this->video->getFeed());
		return XMLLoader::loadString($unserialized);
	}
}

?>