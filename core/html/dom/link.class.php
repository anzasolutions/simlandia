<?php

/**
 * Handle html link tag.
 * @author anza
 * @since 24-10-2010
 */
class Link extends DOMObject
{
	private $link;
	private $value;
	
	public function __construct($link, $value)
	{
		$this->link = $link;
		$this->value = $value;
	}
	
	public function __toString()
	{
		return '<a href="' . $this->link . '"' . $this->id . $this->name . $this->class . $this->style . '>' . $this->value . '</a>' . "\n";
	}
}

?>