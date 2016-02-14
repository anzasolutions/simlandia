<?php

class Navigator
{
	public static function redirectTo($location = null)
	{
		$location = $location == null ? URL_APP : URL_APP . self::getController($location);
		header("Location: " . $location);
		die();
	}
	
	public static function redirectToURL($url)
	{
		header("Location: " . $url);
		die();
	}
	
	private static function getController($location)
	{
		$location = strtolower($location);
		$pattern = '/controller/';
		$match = Regex::match($pattern, $location);
		if ($match > 0)
			$location = Regex::replace($pattern, '', $location);
		return $location;
	}
}

?>