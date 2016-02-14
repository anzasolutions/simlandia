<?php

/**
 * Generate different types of hash.
 * @author anza
 * @since 04-12-2010
 */
class HashGenerator
{
	public static function generateMD5($string)
	{
		return md5($string);
	}
	
	public static function generateSHA1($string)
	{
		return sha1($string);
	}
}

?>