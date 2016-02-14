<?php

/**
 * Contain common activities on user.
 * @author anza
 * @version 31-10-2010
 */
abstract class ItemController extends SessionController
{
	protected $id;
	
	/**
	 * Set login from URL's action.
	 * First parameter is set as action.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->url->setParamAsAction();
		$this->id = $this->url->getParameter(0);
	}
}

?>