<?php

/**
 * Java like String class.
 * @author anza
 * @since 17-10-2010
 */
final class String
{
	// TODO: to be finshed???
	public function parseInt($value)
	{
		if (!settype($value, "int"))
			throw new Exception('This is not an int!', 0);
		return $value;
	}
}

?>