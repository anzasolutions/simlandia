<?php

/**
 * Hold values transferres between layers.
 * @author anza
 * @version 14-04-2011
 */
class Values extends Container
{
    private static $instance;
    
	private function __construct()
	{
	}
	
	public static function getInstance()
    {
    	if (!self::$instance)
    	{
    		self::$instance = new self();
    	}
    	return self::$instance;
    }
	
	/**
	 * Remove all values.
	 */
	public function flush()
	{
		$values = array();
	}
}

?>