<?php

/**
 * Common for all container classes.
 * @author anza
 * @version 24-08-2011
 */
abstract class Container
{
	protected $values;

	public function __set($index, $value)
	{
		$this->values[$index] = $value;
	}
	
	public function __get($index)
	{
		if (isset($this->values[$index])) {
			return $this->values[$index];
		}
	}
}

?>