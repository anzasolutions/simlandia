<?php

/**
 * Fill VideoTO for view.
 * @author anza
 * @version 18-08-2011
 */
class DailyMotionFiller extends AbstractFiller
{
	protected function fillVideo()
	{
		$this->videoTO->setTitle($this->details->title);
		$this->videoTO->setDescription(isset($this->details->description) ? $this->details->description : '');
		
		$length = TimeConverter::formatToMinutes($this->details->duration);
		$this->videoTO->setLength($length);
		
		$thumbnail = $this->details->thumbnail_medium_url;
		$this->videoTO->setThumbnail($thumbnail);
		
		return $this->videoTO;
	}
	
	// @Override
	protected function getVideoDetails()
	{
		$unserialized = unserialize($this->video->getFeed());
		return json_decode($unserialized);
	}
}

?>