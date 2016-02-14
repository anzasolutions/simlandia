<?php

/**
 * Create a DB driver.
 * @author anza
 * @since 17-10-2010
 */
abstract class DriverFactory
{
    private static $instance;
    
	/**
	 * Get requested DB driver.
	 * By default XML configured driver is return.
	 * @param string $type
	 * @return Driver
	 */
	public static function getDriver($type = null)
	{
		if (!self::$instance)
    	{
			$config = XMLLoader::load(DB_FILE);
			if ($type == null)
				$type = $config->driver;
			$driver = $type.DRIVER;
    		self::$instance = new $driver($config);
    	}
    	return self::$instance;
	}
}

?>