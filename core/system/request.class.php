<?php

/**
 * Wrapper for $_GET, $_POST, $_FILES and $_REQUEST.
 * Single request is handled based on its type.
 * @author anza
 * @since 03-10-2010
 */
class Request extends Container
{
    private static $instance;
    
	private function __construct()
	{
		$this->detectMethod();
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
	 * Check whether request contains specific set of keys.
	 * Even single wrong key fail the check.
	 * @param array $keys Array of key strings to be checked.
	 * @return boolean True if request contains all provided key strings.
	 */
	public function hasKeys(array $keys)
	{
		foreach ($keys as $value)
		{
			if (!array_key_exists($value, $this->values))
			{
				return false;
			}
		}
		return true;
	}
	
	/**
	 * Enriched version of hasKeys.
	 * Checks whether request contains specific key(s) string or array passed to method.
	 * Condition must be true in full to success the check.
	 * 
	 * @param mixed $keys Array set of keys or key string to check.
	 * @return boolean Condition must be true in full to success the check.
	 */
	//TODO: should hasKeys be replaced by this method or maybe below mechanism applied to hasKeys and hasKey to be removed?
	public function hasKey($keys)
	{
		$hasKey = true;
		
		if (is_string($keys))
		{
			if (!array_key_exists($keys, $this->values))
			{
				return false;
			}
		}
		else if (is_array($keys))
		{
			$hasKey = $this->hasKeys($keys);
		}
		else
		{
			$hasKey = false;
		}
		
		return $hasKey;
	}

	/**
	 * Remove element by a given key.
	 * @param string $element
	 */
	public function remove($element)
	{
		unset ($this->values[$element]);
	}

    /**
     * Retrieve all Request values.
     * @return all values
     */
    public function getValues()
    {
        return $this->values;
    }
    
    /**
     * Get selected Request value.
     * @param string $key
     * @return selected value
     */
    public function valueOf($key)
    {
    	if (isset($this->values[$key])) {
	    	return $this->values[$key];
    	}
    }
    
    /**
     * Replace value by new one.
     * @param string $key
     * @param string $value
     * @return new value
     */
    public function replace($key, $value)
    {
    	return $this->values[$key] = $value;
    }
    
    /**
     * Detects request method.
     */
    private function detectMethod()
    {
    	switch ($_SERVER['REQUEST_METHOD'])
    	{
    		case 'POST':
    			$this->values = $_POST;
    			break;
    		case 'GET':
    			$this->values = $_GET;
    			break;
    		case 'FILES':
    			$this->values = $_FILES;
    			break;
    		default:
    			$this->values = $_REQUEST;
    	}
    }
}

?>