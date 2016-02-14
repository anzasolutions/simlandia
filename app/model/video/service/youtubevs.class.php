<?php

/**
 * Handle video data of YouTube service.
 * @author anza
 * @version 16-08-2011
 */
class YouTubeVS extends AbstractVS
{
	const API = 'http://gdata.youtube.com/feeds/api/videos/';
	
	protected function requestFeed()
	{
		$this->extractId();
		$this->verifyId();
		$this->feed = file_get_contents($this->xml);
	}
	
	private function extractId()
	{
		parse_str(parse_url($this->url, PHP_URL_QUERY));
		$this->id = $v;
		$this->xml = self::API . $this->id;
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