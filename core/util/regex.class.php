<?php

class Regex
{
	public static function replace($pattern, $replacement, $subject)
	{
		return preg_replace($pattern, $replacement, $subject);
	}
	
	public static function match($pattern, $subject)
	{
		return preg_match($pattern, $subject);
	}
}

?>