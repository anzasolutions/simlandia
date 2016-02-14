<?php

/**
 * Fill VideoTO for view.
 * @author anza
 * @version 18-08-2011
 */
class YouTubeFiller extends AbstractFiller
{
	protected function fillVideo()
	{
		$media = $this->details->children('http://search.yahoo.com/mrss/');
		
		$this->videoTO->setTitle($media->group->title);
		$this->videoTO->setDescription($media->group->description);
		
		$yt = $media->children('http://gdata.youtube.com/schemas/2007');
		$attrs = $yt->duration->attributes();
		$time = intval($attrs['seconds']);
		$length = TimeConverter::formatToMinutes($time);
		$this->videoTO->setLength($length);
		
		$attrs = $media->group->thumbnail[0]->attributes();
		$thumbnail = $attrs['url'];
		$this->videoTO->setThumbnail($thumbnail);
		
		return $this->videoTO;
	}
}

?>