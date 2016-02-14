<?php

/**
 * Factory producing VideoTOs for display.
 * @author anza
 * @version 18-08-2011
 */
class VideoFiller
{
	private function __construct()
	{
	}
	
	public static function fillVideo(Video $video)
	{
		$videoType = DAOFactory::getVideoTypeDAO()->findById($video->getType());
		$videoTypeName = $videoType->getName() . 'Filler';
		$filler = new $videoTypeName($video);
		$video = $filler->getVideoTO();
		$video->setType($videoType->getName());
		return $video;
	}
}

?>