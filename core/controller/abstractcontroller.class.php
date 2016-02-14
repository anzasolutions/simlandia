<?php

/**
 * Default controller.
 * Should be extended by all controllers.
 * @author anza
 * @version 30-09-2010
 */
abstract class AbstractController
{
	const INDEX = 'index';
	const ERROR = 'error';
	
	protected $url;
	protected $model;
	protected $view;
	protected $request;
	protected $values;
	
	public function __construct()
	{
		$this->url = URL::getInstance();
		$this->request = Request::getInstance();
		$this->values = Values::getInstance();
	}
	
	/**
	 * Default action of each controller.
	 * Must be overriden in subclass' implementation.
	 */
	protected abstract function index();
	
	/**
	 * Handles 404 error.
	 */
	protected function error()
	{
	}
	
	/**
	 * Launch requested action of controller.
	 * Missing or incorrect action will be replaced by default one.
	 */
	public function execute($action = null)
	{
		$action = $this->url->getAction() == null ? self::INDEX : $this->url->getAction();
		if (!$this->isCallable($action) || !$this->hasAnnotation($action, 'Invocable'))
			$action = self::ERROR;
		$this->$action();
		// TODO: is this really nice and ok???
//		if (!$this->hasAnnotation($action, 'WebMethod'))
			$this->view->display($action);
	}

	/**
	 * Check whether given method can be invoked.
	 * @param string $method
	 * @return boolean
	 */
	private function isCallable($method)
	{
		return is_callable(array($this, $method));
	}
	
	/**
	 * Check whether particular method is annotated.
	 * @param string $method Tested method.
	 */
	private function hasAnnotation($method, $annotation)
	{
		$reflection = new ReflectionAnnotatedMethod($this, $method);
		return $reflection->hasAnnotation($annotation);
	}
	
//	public function isService()
//	{
//		$reflection = new ReflectionAnnotatedClass($this);
//		return $reflection->hasAnnotation('WebService');
//	}
	
	/**
	 * To be called whenever error 404 should occur.
	 */
	public function redirectToError()
	{
		$this->setAction(ERROR);
	}
	
	// TODO: below function as well as redirectToError must be merged somehow with execute
	// TODO: this should be considered temporary workaround to avoid double template rendering
	protected function setAction($action)
	{
		$this->url->setAction($action);
		$this->execute();
		die();
	}

	public function setModel(AbstractModel $model)
	{
	    $this->model = $model;
	}

	public function setView(AbstractView $view)
	{
	    $this->view = $view;
	}
	
	public function __toString()
	{
		return get_class($this);
	}
}

?>