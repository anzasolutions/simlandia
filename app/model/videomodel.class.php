<?php

/**
 * Handle video business logic. 
 * @author anza
 * @version 09-08-2011
 */
class VideoModel extends AbstractModel
{
	public function save(Video $video)
	{
		return DAOFactory::getVideoDAO()->save($video);
	}
	
	public function checkUser($login)
	{
		return DAOFactory::getUserDAO()->findByLogin($login);
	}
	
	public function add(NewVideoFO $fo)
	{
		$detector = new VideoServiceDetector($fo->getLink());
		$video = $this->makeVideo($detector);
		DAOFactory::getVideoDAO()->save($video);
	}
	
	private function makeVideo(VideoServiceDetector $detector)
	{
		$user = Session::get('user');
		
		$video = new Video();
		$video->setSourceId($detector->getId());
		$video->setUserid($user->getId());
		$video->setAdded(null);
		$video->setType($detector->getType()->getId());
		$video->setFeed(Serializer::serialize($detector->getFeed()));
		return $video;
	}
	
	public function getLatestUserVideos($limit = 5, $profileId)
	{
		$videos = DAOFactory::getVideoDAO()->findLatestForUser($limit, $profileId);
		return $this->fillVideos($videos);
	}
	
	public function getLatestVideos($limit = 5)
	{
		$videos = DAOFactory::getVideoDAO()->findLatest($limit);
		return $this->fillVideos($videos);
	}
	
	private function fillVideos($videos)
	{
		foreach ($videos as $video)
		{
			$videoTOs[] = VideoFiller::fillVideo($video);
		}
		return $videoTOs;
	}
	
	public function getVideo($id)
	{
		$video = DAOFactory::getVideoDAO()->findById($id);
		return VideoFiller::fillVideo($video);
	}
}

?>