<?php

/**
 * Handle video data of DailyMotion service.
 * @author anza
 * @version 18-08-2011
 */
class DailyMotionVS extends AbstractVS
{
	const API = 'https://api.dailymotion.com/video/';
	const PARAMS = '?fields=title,thumbnail_url,duration,thumbnail_url,thumbnail_medium_url,thumbnail_large_url';
	
	protected function requestFeed()
	{
		$this->extractId();
		$this->verifyId();
		$this->feed = file_get_contents($this->xml);
	}
	
	private function extractId()
	{
		$pattern = '/dailymotion\.com\/video\/([a-z0-9]{1,6})/';
		preg_match($pattern, $this->url, $matches);
		$this->id = $matches[1];
		echo $this->xml = self::API . $this->id . self::PARAMS;
	}
	
	private function verifyId()
	{
		$headers = get_headers($this->xml);
		if (!strpos($headers[0], '200'))
		{
			throw new VideoNotExistsException();
		}
	}
}

?>