<?php

class SelectGenerator
{
	private $request;
	
	public function __construct($request)
	{
		$this->request = $request;
	}
	
	protected function makeOption($value, $content, $name)
	{
		$option = DOMFactory::getOption($value)->addContent($content);
		if ($this->request->valueOf($name) == $value)
			$option->addSelected(true);
		return $option;
	}
}

?>