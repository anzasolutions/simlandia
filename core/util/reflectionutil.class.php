<?php

/**
 * Reflection mechanism wrapper.
 * @author anza
 * @since 05-10-2010
 */
class ReflectionUtil
{
	public static function getObjectType($object)
	{
		return get_class($object);
	}
	
	public static function printObjectType($object)
	{
		echo self::getObjectType($object);
	}
	
	// TODO: refactor if necessary as looks too complicated
	public static function getProperties($object)
	{
		$reflection = new ReflectionObject($object);
		$props = $reflection->getProperties();
		foreach ($props as $prop)
		{
			$prop = $reflection->getProperty($prop->getName());
			echo $prop;
			$prop->setAccessible(true);
			$result[$prop->getName()] = $prop->getValue($object);
		}
		return $result;
	}
	
	public static function hasInterface($class, $interface)
	{
		$class = new ReflectionClass($class);
		return $class->implementsInterface($interface);
	}
	
	public static function getClass($class)
	{
		return new ReflectionClass($class);
	}
}

?>