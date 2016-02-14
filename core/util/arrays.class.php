<?php

/**
 * Contain util functions handling arrays.
 * @author anza 03-04-2011
 */
class Arrays
{
	/**
	 * Run a match on the array's keys rather than the values
	 * @author keithbluhm
	 * @link http://www.php.net/manual/en/function.preg-grep.php#95787
	 * @param string $pattern Regex pattern to search
	 * @param array $input Search will be perfomed on it
	 * @param integer $flags
	 * @return array $vals Filled with found keys
	 */
	public static function findKeys($pattern, $input, $flags = 0)
	{
		$keys = preg_grep($pattern, array_keys($input), $flags);
		$vals = array();
		foreach ($keys as $key)
			$vals[$key] = $input[$key];
		return $vals;
	}
	
	public static function size($array)
	{
		return sizeof($array);
	}
}

?>