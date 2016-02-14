<?php

/**
 * Load and parse XML file. 
 * @author anza
 * @since 03-10-2010
 */
class XMLLoader
{
	/**
	 * Load and parse XML file.
	 * @author anza
	 * @param string $file
	 * @throws FileNotFoundException
	 * @return object SimpleXMLElement
	 */
	public static function load($file)
	{
		if (!file_exists($file))
			throw new FileNotFoundException($file);
		return simplexml_load_file($file);
	}
	
	/**
	 * Load and parse remote XML.
	 * @author anza
	 * @param string $file
	 * @return object SimpleXMLElement
	 */
	public static function loadUrl($file)
	{
		return simplexml_load_file($file);
	}
	
	/**
	 * Load and parse given XML string.
	 * @author anza
	 * @param string $xml
	 * @return object SimpleXMLElement
	 */
	public static function loadString($xml)
	{
		return simplexml_load_string($xml);
	}
}

?>