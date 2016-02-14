<?php

/**
 * Validate and execute requested route.
 * @author anza
 * @version 01-07-2011
 */
class Router
{
	public static function dispatch()
	{
		$url = URL::getInstance();
		$name = self::validate($url->getController());
		$controller = ControllerFactory::create($url->getController());
		$controller->execute();
	}
	
	/**
	 * Validate controller's scope and context. 
	 * @param string $name
	 * @return string Validated controller name.
	 */
	// TODO: must be refactored as it looks awful !!!
	// TODO: should Scope constants be replaced by annotations?
	private static function validate($name)
	{
		try
		{
			$url = URL::getInstance();
			
			if ($name == null)
			{
				if (Session::getInstance()->isStarted())
				{
					$url->setController(DEFAULT_SESSION_CONTROLLER);
					$url->setAction(DEFAULT_SESSION_ACTION);
					return DEFAULT_SESSION_CONTROLLER;
				}
				else
				{
					$url->setController(DEFAULT_REQUEST_CONTROLLER);
					$url->setAction(DEFAULT_REQUEST_ACTION);
					return DEFAULT_REQUEST_CONTROLLER;
				}
			}
				
			$controller = $name.CONTROLLER;
			$class = new ReflectionClass($controller);
			
			if ($class->isAbstract())
				throw new LogicException();
			
			$classScope = $class->getConstant('SCOPE');
			if ($class->implementsInterface('Context'))
			{
				if (Scope::isAcceptable($classScope))
					return $name;
					
				if ($classScope == Scope::SESSION)
				{
					$url->setController(DEFAULT_REQUEST_CONTROLLER);
					$url->setAction(DEFAULT_REQUEST_ACTION);
					return DEFAULT_REQUEST_CONTROLLER;
				}
				
				if ($classScope == Scope::REQUEST)
					ControllerFactory::create(DEFAULT_APPLICATION_CONTROLLER)->redirectToError();
			}
			return DEFAULT_APPLICATION_CONTROLLER;
		}
		catch (LogicException $e)
		{
			$e->getTraceAsString();
			ControllerFactory::create(DEFAULT_APPLICATION_CONTROLLER)->redirectToError();
		}
	}
}

?>