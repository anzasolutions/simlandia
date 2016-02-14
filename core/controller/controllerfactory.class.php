<?php

/**
 * Create controllers.
 * @author anza
 * @version 2010-09-19
 */
class ControllerFactory
{
	public static function create($name)
	{
		$controller = $name.CONTROLLER;
		$controller = new $controller();
		$model = $name.MODEL;
		$controller->setModel(new $model());
		$view = $name.VIEW;
		$controller->setView(new $view());
		return $controller;
	}
}

?>