<?php

/**
 * Produce objects handling HTML tags.
 * @author anza
 * @since 24-10-2010
 */
abstract class DOMFactory
{
	public static function getLink($url, $value)
	{
		return new Link($url, $value);
	}
	
	public static function getImage($src)
	{
		return new Image($src);
	}
	
	public static function getDiv($content = null)
	{
		return new Div($content);
	}
	
	public static function getSelect()
	{
		return new Select();
	}
	
	public static function getOption($value)
	{
		return new Option($value);
	}
	
	public static function getLi($value)
	{
		return new Li($value);
	}
}

?>