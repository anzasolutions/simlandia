<?php

/**
 * Handle video data of Vimeo service.
 * @author anza
 * @version 16-08-2011
 */
class VimeoVS extends AbstractVS
{
	const API = 'http://vimeo.com/api/v2/video/';
	const FORMAT = '.xml';
	
	protected function requestFeed()
	{
		$this->extractId();
		$this->verifyId();
	}
	
	private function extractId()
	{
		$pattern = '/vimeo\.com\/([0-9]{1,10})/';
		preg_match($pattern, $this->url, $matches);
		if ($matches[1] == null)
		{
			throw new VideoNotExistsException();
		}
		$this->id = $matches[1];
		$this->xml = self::API . $this->id . self::FORMAT;
	}
	
	private function verifyId()
	{
		$this->feed = file_get_contents($this->xml);
		$xml = XMLLoader::loadString($this->feed);
		foreach ($xml->children() as $video)
		{
			if ($video->id == '')
			{
				throw new VideoNotExistsException();
			}
		}
	}
}

?>