<?php

/**
 * Generate img element.
 * @author anza
 * @since 14-11-2010
 */
class Image extends DOMObject
{
	private $src;
	
	public function __construct($src)
	{
		$this->src = $src;
	}
	
	public function __toString()
	{
		return '<img src="' . $this->src . '"' . $this->id . $this->name . $this->class . $this->style . ' />' . "\n";
	}
}

?>