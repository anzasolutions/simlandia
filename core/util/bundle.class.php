<?php

/**
 * Retrieve texts from localized text bundles.
 * @author anza
 * @version 15-06-2011
 */
// TODO: must be refactored !!!
abstract class Bundle
{
	public static function get()
	{
		// TODO: we must load a file based on locale!
		$messages = file(PATH_MESSAGES . 'messages' . EXT_PROPS);
		$keys = array();
		$values = array();
		
		foreach ($messages as $value)
		{
			$row = explode(' = ', $value);
			$keys[] = $row[0];
			$values[] = trim(isset($row[1]) ? $row[1] : '');
		}
		
		$messages2 = array_combine($keys, $values);
		
		$args = func_get_args();
		$key = $args[0];
		
		if (array_key_exists($key, $messages2))
		{
			if (strpos($messages2[$key], '{}'))
			{
				$p = explode('{}', $messages2[$key]);
				foreach ($p as $k => $v)
				{
					if (isset($args[$k+1])) {
						$p[$k] .= $args[$k+1];
					}
				}
				$messages2[$key] = implode('', $p);
			}
			return $messages2[$key];
		}
	}
}

?>