<?php

/**
 * Fill VideoTO for view.
 * @author anza
 * @version 18-08-2011
 */
class VimeoFiller extends AbstractFiller
{
	protected function fillVideo()
	{
		foreach ($this->details->children() as $video)
		{
			$this->videoTO->setTitle($video->title);
			$this->videoTO->setDescription($video->description);
			
			$length = TimeConverter::formatToMinutes($video->duration);
			$this->videoTO->setLength($length);
			
			$thumbnail = $video->thumbnail_medium;
			$this->videoTO->setThumbnail($thumbnail);
		}
		return $this->videoTO;
	}
}

?>