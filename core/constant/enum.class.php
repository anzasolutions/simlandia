<?php

abstract class Enum
{
	public function getConstants()
	{
		$reflection = new ReflectionObject($this);
		return $reflection->getConstants();
	}
	
	public function getConstant($name)
	{
		$reflection = new ReflectionObject($this);
		return $reflection->getConstant($name);
	}
}

?>