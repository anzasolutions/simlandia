<?php

/**
 * Contain URL request with actions.
 * @author anza
 * @version 2010-09-20
 */
final class URL
{
    private static $instance;
    
	private $elements;
	private $controller = null;
	private $action = null;
	private $parameters = array();
    
    private function __construct()
    {
    	$this->elements = $this->trim(isset($_GET['action']) ? $_GET['action'] : '');
    	if ($this->hasElements())
    		$this->extractElements();
    }
	
	public static function getInstance()
    {
    	if (!self::$instance)
    		self::$instance = new self();
    	return self::$instance;
    }
	
	/**
	 * Trim URL from all unwanted characters.
	 * @return string Trimmed URL elements.
	 */
	private function trim($element)
	{
		return trim($element, TRIM_PATTERN);
	}
	
	/**
	 * Check base URL for controller, action and parameters. 
	 * @return boolean
	 */
	private function hasElements()
	{
		return strlen($this->elements) > 0;
	}
	
	/**
	 * Split URL into more meaningful elements.
	 */
	private function extractElements()
	{
		$elements = $this->separateElements();
		
		if ($elements[0] == null)
			return;
		$this->controller = $elements[0];
		
		if (isset($elements[1])) {
			if ($elements [1] == null)
				return;
			$this->action = $elements [1];
		}
		
		if (isset($elements[2]) && $elements[2] == null)
			return;
		$this->parameters = array_slice($elements, 2);
	}
	
	/**
	 * Separate controller, action and parameters from string.
	 * @return array Strings representing controller, action and parameters.
	 */
	private function separateElements()
	{
		return explode(SLASH, $this->elements);
	}
	
	/**
	 * Return combined controller and action path.
	 */
	public function getActionPath($action = null)
	{
		if ($action == null)
			$action = $this->action;
		return $this->controller . SLASH . $action;
	}
	
	/**
	 * Return combined controller and action URL.
	 */
	public function getActionURL($action = null)
	{
		return URL_APP . $this->getActionPath($action);
	}
	
	public function getActionParamURL($action, array $params)
	{
		$url = URL_APP . $this->getActionPath($action);
		if ($params != null)
			foreach ($params as $param)
				$url .= SLASH . $param;
		return $url;
	}
	
	public function getParamURL(array $params)
	{
		$url = URL_APP . $this->controller . SLASH . $this->action;
		if ($params != null)
			foreach ($params as $param)
				$url .= SLASH . $param;
		return $url;
	}
	
	/**
	 * Return custom controller and action URL.
	 */
	public function getCustomActionURL($controller = null, $action = null, array $parameters = null)
	{
//		$controller = $controller == null ? $this->controller : $controller;
//		$action = $action == null ? $this->action : $action;
		
		$url = URL_APP . $controller . SLASH . $action;
		if ($parameters != null)
			foreach ($parameters as $parameter)
				$url .= SLASH . $parameter;
		return $url;
	}
	
	/**
	 * Return combined controller, action and parameters path.
	 */
	public function getParametersPath($parameters = null)
	{
		return $this->controller . SLASH . $this->action . SLASH . $parameters;
	}
	
	public function getController()
	{
		return $this->controller;
	}
	
	public function setController($controller)
	{
		$this->controller = $controller;
	}
	
	public function getAction()
	{
		return $this->action;
	}
	
	public function setAction($action)
	{
		$this->action = $action;
	}
	
	public function getParameters()
	{
		return $this->parameters;
	}
	
	/**
	 * Get particular parameter by a key.
	 */
	public function getParameter($key)
	{
		return isset($this->parameters[$key]) ? $this->parameters[$key] : '';
	}
	
	/**
	 * Check whether URL has parameters.
	 */
	public function hasParameters()
	{
		return sizeof($this->parameters) > 0;
	}
	
	/**
	 * Ocasionally it's more convinient to have in URL an action
	 * on a first parameter position and the param on the action's.
	 * But in order to process controller's action properly
	 * the URL param action must be moved to a proper action position.
	 * The URL action param will be moved to a first param position. 
	 */
	public function setParamAsAction()
	{
		$id = $this->action;
		$this->action = $this->hasParameters() ? $this->parameters[0] : '';
		$this->parameters[0] = $id;
	}
	
	public function getURL()
	{
		$url = URL_APP . $this->controller . SLASH . $this->action;
		foreach ($this->parameters as $parameter)
			$url .= SLASH . $parameter;
		return $url;
	}
}

?>