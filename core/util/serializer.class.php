<?php

/**
 * Execute serialization tasks.
 * @author anza
 * @version 20-08-2011
 */
class Serializer
{
	/**
	 * PHP's serialize() delegator.
	 * @param any type $value Non-serialized value.
	 * @return string Serialized value.
	 */
	public static function serialize($value)
	{
		return serialize($value);
	}
	
	/**
	 * PHP's unserialize() delegator.
	 * @param any type $value Serialized value.
	 * @return string Unserialized value.
	 */
	public static function unserialize($serialized)
	{
		return unserialize($serialized);
	}
}

?>