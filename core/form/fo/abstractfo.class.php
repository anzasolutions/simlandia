<?php

/**
 * Basic form object class.
 * @author anza
 * @version 12-06-2011
 */
abstract class AbstractFO
{
	const PROCESS = 'process';
	
	protected $request;
	
	public function __construct()
	{
		$this->request = Request::getInstance();
		if (!$this->isSent())
			return;
		$this->bind();
		$this->validate();
	}
	
	/**
	 * Bind values from form to FO. 
	 */
	protected abstract function bind();
	
	/**
	 * Validate binded values.
	 */
	protected abstract function validate();
	
	/**
	 * Check whether form has been explicitly sent.
	 * Submit button must be set with specific name.
	 * @return boolean
	 */
	public function isSent()
	{
		return $this->request->hasKey(self::PROCESS);
	}
}

?>